@extends('layouts.app')

@section('content')
    <div class="container">
        <div class = "position">
            <div>
                <div>
                    <h1 class="page-title">吃什麼好勒?</h1>
                </div>
                <div class="turntable-wrap">
                    <div class="light" id="turntable_light"></div>
                    <div class="turntable" id="turntable">
                        <ul class="bg" id="turntable_bg"></ul>
                        <ul class="gift" id="turntable_gift"></ul>
                    </div>
                    <div class="pointer disabled" id="turntable_pointer">點擊開始</div>
                </div>
            </div>

            <div>
                <ul id="food-list">
                    <li class="food-item" id="food-1">1. 火鍋
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/hotpot.svg" alt="火鍋" height="90px" width="50px">
                    </li>
                    <li class="food-item" id="food-2">2. 拉麵
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/ramen.svg" alt="拉麵" height="90px" width="90px">
                    </li>
                    <li class="food-item" id="food-3">3. 漢堡
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/hamburger.svg" alt="漢堡" height="92px" width="92px">
                    </li>
                    <li class="food-item" id="food-4">4. 披薩
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/pizza.svg" alt="披薩" height="92px" width="92px">
                    </li>
                    <li class="food-item" id="food-5">5. 全家
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/family.svg" alt="全家" height="92px" width="92px">
                    </li>
                </ul>
            </div>
            <div>
                <ul id="food-list">
                    <div class="food-item" id="food-6">6. 壽司
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/sushi.svg" alt="壽司" >
                    </div>
                    <li class="food-item" id="food-7">7. 韓式
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/korea.svg" alt="韓式" height="100%" width="100%">
                    </li>
                    <li class="food-item" id="food-8">8. 壽喜燒
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/sukiyaki.svg" alt="壽喜燒">
                    </li>
                    <li class="food-item" id="food-9">9. 鐵板燒
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/teppanyaki.svg" alt="鐵板燒" height="80px" width="85px">
                    </li>
                    <li class="food-item" id="food-10">10. 義大利麵
                        <img class="pic" src="http://localhost:8080/Meal/public/images/turntable/pasta.svg" alt="義大利麵" height="92px" width="92px">
                    </li>
                </ul>
            </div>
        </div>

        <script>
            let turntable = {
                itemNum: 10, // 轉盤平均分幾塊
                lightNum: 18, // 燈
                light: null, // 燈容器
                turntable: null, // 轉盤
                bg: null, // 轉盤背景
                pointer: null, // 指針

                typeMap: {
                    1: '1',
                    2: '2',
                    3: '3',
                    4: '4',
                    5: '5',
                    6: '6',
                    7: '7',
                    8: '8',
                    9: '9',
                    10: '10'
                },
                typeClassMap: {
                    1: 'no-gift',
                    2: 'no-gift',
                    3: 'no-gift',
                    4: 'no-gift',
                    5: 'no-gift',
                    6: 'no-gift',
                    7: 'no-gift',
                    8: 'no-gift',
                    9: 'no-gift',
                    10: 'no-gift'
                },

                isGoing: false, // 遊戲是否開始

                init() {
                    if (!this.lottery.length) {
                        this.pointer.style.display = 'none';
                        throw new Error('請設置中獎結果數據');
                    }

                    // 燈初始化
                    let lightFragment = document.createDocumentFragment();
                    for (let i = 0; i < this.lightNum; i++) {
                        let lightItem = document.createElement('span');
                        let deg = (360 / this.lightNum) * i
                        lightItem.style.transform = `rotate(${deg}deg)`;
                        lightFragment.appendChild(lightItem);
                    }
                    this.light.appendChild(lightFragment);

                    // 初始化轉盤背景、中獎圖
                    let bgFragment = document.createDocumentFragment();
                    let bgItemWidth = this.bg.offsetWidth / this.num;
                    let giftFragment = document.createDocumentFragment();
                    for (let i = 0; i < this.itemNum; i++) {
                        let bgItem = document.createElement('li');
                        let deg = (360 / this.itemNum) * i
                        bgItem.style.transform = `rotate(${deg}deg)`;
                        bgFragment.appendChild(bgItem);

                        let giftItem = document.createElement('li');
                        giftItem.style.transform = `rotate(${deg}deg)`;
                        giftItem.className = this.typeClassMap[this.lottery[i].type];
                        let span = document.createElement('span');
                        span.innerHTML = this.typeMap[this.lottery[i].type];
                        giftItem.appendChild(span);
                        giftFragment.appendChild(giftItem)
                    }
                    this.bg.appendChild(bgFragment);
                    this.gift.appendChild(giftFragment);


                    this.pointer.onclick = this.gameStart.bind(this)
                },

                gameStart() {
                    if (this.isGoing) {
                        return
                    }
                    this.isGoing = true;

                    // 隨機中獎結果
                    // 1-100隨機數
                    let randomRate = ~~(Math.random() * 100) // ~~ == Math.floor()
                    // 中獎概率範圍
                    let num = 0
                    this.lottery.forEach(item => {
                        item.min = num;
                        num += item.rate;
                        item.max = num;
                    })

                    let res = this.lottery.filter(item => {
                        return randomRate >= item.min && randomRate < item.max;
                    })[0];


                    // 轉五圈，轉1圈用時1s
                    let rotateItemDeg = ((res.location - 1) * (360 / this.lottery.length)) + (180 / this.lottery.length);
                    let rotate = rotateItemDeg + 5 * 360;
                    let rotateSpeed = (rotateItemDeg / 360 * 1 + 5).toFixed(2);
                    // 重置轉盤
                    this.turntable.removeAttribute('style');
                    // 旋轉動畫
                    setTimeout(() => {
                        this.turntable.style.transform = `rotate(${rotate}deg)`;
                        this.turntable.style.transition = `transform ${rotateSpeed}s ease-out`;
                    }, 10)

                    // 顯示結果
                    setTimeout(() => {
                        this.isGoing = false;
                        let resultText = this.typeMap[res.type];
                        document.querySelectorAll('.food-item').forEach(item => {
                            item.classList.remove('highlight');
                        });
                        let resultElement = document.getElementById(`food-${res.type}`);
                        resultElement.classList.add('highlight');
                        console.log('結果：', randomRate, res, this.typeMap[res.type]);
                    }, rotateSpeed * 1000);
                }
            }

            let lottery = [{
                    location: 10, 
                    type: 10, 
                    rate: 10,
                },
                {
                    location: 9,
                    type: 9, 
                    rate: 10
                },
                {
                    location: 8,
                    type: 8,
                    rate: 10
                },
                {
                    location: 7,
                    type: 7,
                    rate: 10
                },
                {
                    location: 6,
                    type: 6,
                    rate: 10
                },
                {
                    location: 5,
                    type: 5,
                    rate: 10
                },
                {
                    location: 4,
                    type: 4,
                    rate: 10
                },
                {
                    location: 3,
                    type: 3,
                    rate: 10
                },
                {
                    location: 2,
                    type: 2,
                    rate: 10
                },
                {
                    location: 1,
                    type: 1,
                    rate: 10
                }
            ];

            turntable.turntable = document.querySelector('#turntable');
            turntable.light = document.querySelector('#turntable_light');
            turntable.bg = document.querySelector('#turntable_bg');
            turntable.gift = document.querySelector('#turntable_gift');
            turntable.pointer = document.querySelector('#turntable_pointer');
            turntable.lottery = lottery;
            turntable.init();
        </script>
    </div>
@endsection

@push('scripts')
    <script>
        window.onload = function() {
            var surpriseSVG = document.getElementById('surpriseSVG');
            if (surpriseSVG) {
                // Clear existing content
                surpriseSVG.innerHTML = '';

                // Add new SVG content
                surpriseSVG.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M11.1 7.19043H4C3.05719 7.19043 2.58579 7.19043 2.29289 7.48332C2 7.77622 2 8.24762 2 9.19043V11.0234C2 11.9662 2 12.4377 2.29289 12.7305C2.5452 12.9829 2.92998 13.0178 3.63447 13.0227H11.1V7.19043ZM5.33333 14.8227V20.1904C5.33333 21.1332 5.33333 21.6046 5.62623 21.8975C5.91912 22.1904 6.39052 22.1904 7.33333 22.1904H11.1V14.8227H5.33333ZM12.9 22.1904H16.6667C17.6095 22.1904 18.0809 22.1904 18.3738 21.8975C18.6667 21.6046 18.6667 21.1332 18.6667 20.1904V14.8227H12.9V22.1904ZM20.7724 13.0227C21.0648 13.0198 21.2388 13.0069 21.3827 12.9473C21.6277 12.8458 21.8224 12.6511 21.9239 12.4061C22 12.2223 22 11.9894 22 11.5234V9.19043C22 8.24762 22 7.77622 21.7071 7.48332C21.4142 7.19043 20.9428 7.19043 20 7.19043H12.9V13.0227H20.7724Z"
                    fill="currentColor" />
                <path
                    d="M16.2645 6.12593L17.8184 5.69084C18.517 5.49523 19 4.85846 19 4.13298C19 3.06172 17.9776 2.28627 16.946 2.57512L16.6334 2.66265C15.2274 3.05634 13.9216 3.74582 12.8036 4.68496L12 5.36V6.2H15.7253C15.9076 6.2 16.089 6.17508 16.2645 6.12593Z"
                    fill="currentColor" />
                <path
                    d="M7.73546 6.12593L6.18158 5.69084C5.48297 5.49523 5 4.85846 5 4.13298C5 3.06172 6.0224 2.28627 7.05398 2.57512L7.3666 2.66265C8.77264 3.05634 10.0784 3.74582 11.1964 4.68496L12 5.36V6.2H8.27472C8.09243 6.2 7.91099 6.17508 7.73546 6.12593Z"
                    fill="currentColor" />
            </svg>`;
            }
        };
    </script>
@endpush
