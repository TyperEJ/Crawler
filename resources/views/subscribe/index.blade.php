<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no">
    <title>Subscribe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/at-ui-style/css/at.min.css">
    <style>
        .at-checkbox{
            margin-left:16px;
        }
        .at-checkbox__label{
            font-size: 8vw;
        }
        .at-checkbox__inner{
            width:50px;
            height:50px;
        }
        .at-checkbox__inner:after{
            width:10px;
            height:20px;
        }
        .confirm-btn >.at-btn__text{
            font-size:40px;
        }
        .confirm-btn{
            padding: 20px 40px;
            margin: 30px auto;
        }
        .at-card__title{
            font-size: 5vw;
        }
    </style>
</head>

<body>
<div id="app">
    <at-card style="width: 100%;">
        <div v-for="tag in tags" :key="tag">
            <at-checkbox-group v-model="items">
                <at-checkbox :label="tag">@{{ tag }}</at-checkbox>
            </at-checkbox-group>
        </div>
        <div class="row at-row no-gutter flex-center" v-if="showBtn">
            <at-button class="confirm-btn" type="primary" @click="send">訂閱確認</at-button>
        </div>
    </at-card>
</div>
<input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/at-ui/dist/at.min.js"></script>
<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    var vm = new Vue({
        el: '#app',
        data: {
            tags: [
                'Lifeismoney/情報',
                'MacShop/pod&台中',
                'MacShop/pod&全國',
                'MobilePay/情報',
                'soho/徵才&程式',
            ],
            uid: null,
            items: [],
            showBtn:false,
        },
        mounted: function () {
            self = this;

            liff.init(function (data) {
                liff.getProfile().then(function (profile) {
                    self.uid = profile.userId;
                }).catch(function (error) {
                    window.alert("Error getting profile: " + error);
                });
            });
        },
        methods:{
            initProfile: function(){
                var profileUrl = '/line-member/'+ this.uid;

                axios.get(profileUrl)
                    .then(function (response) {
                        self.setItems(response.data.keywords);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            setItems: function(keywords){
                keywords.forEach(function(keyword){
                    self.items.push(keyword.board+'/'+keyword.keyword);
                });

                this.showBtn = true;
            },
            send: function(){
                var header = {
                    headers: {
                        'X-CSRF-TOKEN': document.getElementById("csrf_token").value
                    }
                };

                axios.post('/line-member',this.postData,header)
                    .then(function (response) {
                        alert('訂閱成功')
                        liff.closeWindow();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        computed:{
            postData: function(){
                obj = {};

                obj.uid = this.uid;
                obj.keywords = this.items.map(function(item){
                    var [board,keyword] = item.split('/');
                    var subObj = {};

                    subObj.board = board;
                    subObj.keyword = keyword;

                    return subObj;
                });

                return obj;
            }
        },
        watch: {
            uid: function(value) {
                if(value)
                {
                    this.initProfile();
                }
            }
        }
    });
</script>
</html>
