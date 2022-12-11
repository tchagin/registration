@if(isset($member))
    <div class="badge-cart" id="invoice">
        <style>
            .badge-cart{
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                font-family: 'Raleway-Bold', sans-serif;
                color: #000;
                width: 300px;
                height: 300px;
                text-align: center;
                margin: 0 auto;
                padding: 15px;
                border: 1px solid #00699a26;
            }
            .badge-cart .title-firm{
                border-bottom: 1px solid #000;
                padding-bottom: 10px;
            }
            .badge-cart .info{
                padding-top: 10px;
                border-top: 1px solid #000;
            }
            .badge-cart .name{
                padding: 0 5px;
            }
            @media print {
                /*html, body {*/
                /*    width: 45mm;*/
                /*    height: 45mm;*/
                /*}*/
                /*body{*/
                /*    visibility: hidden;*/
                /*}*/
                .actions-block{
                    display: none;
                }
                .header{
                    display: none;
                }
                .section-title{
                    display: none;
                }
                #content{
                    padding-top: 0;
                }
                .container{
                    max-width: 100%;
                    width: 100%;
                    padding: 0;
                }
                .col-sm-6{
                    padding: 0;
                }
                .col-lg-5 .offset-lg-1 .col-md-6{
                    padding: 0;
                    margin-left: 0;
                }

                .badge-cart{
                    visibility: visible;
                    border: none;
                    position: absolute;
                    text-align: center;
                    left: 0;
                    top: 0;
                    right: 0;
                    bottom: 0;
                    display: flex!important;
                    flex-direction: column!important;
                    justify-content: space-between!important;

                    margin: 0 auto;
                    width: 283px;
                    height: 283px;
                    padding: 10px;
                    margin-left: 10px;
                }
                .title-firm{
                    border-bottom: 1px solid #000;
                    font-size: 18px;
                    padding-bottom: 15px;
                    padding-top: 0;
                    line-height: 18px;
                    margin-bottom: 0!important;
                }
                .wrap{
                    padding: 15px 0;
                 }
                .name{
                    font-size: 20px;
                    line-height: 20px;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                .info{
                    border-top: 1px solid #000;
                    padding-top: 10px;
                    margin-bottom: 0;
                    margin-top: 0;
                }
                .title-exhibition{
                    line-height: 15px;
                    font-size: 17px;
                    width: 50%;
                }
                .qr-code{
                    width: 50%;
                }
                .qr-code img{
                    width: 80px!important;
                }
            }
        </style>

        <div class="title-firm">{{ $member->title }}</div>
        <div class="wrap">
            <div class="name">{{ $member->fullName }}</div>
        </div>
        <div class="info d-flex justify-content-around align-items-center w-100">
            <div class="title-exhibition text-center">
                {{ $member->exhibition->title }}
            </div>
            <div class="qr-code">
                <img src="{{ asset('/uploads/qr-code/img-'. $member->id .'.png') }}" alt="" style="width: 120px">
            </div>
        </div>
    </div>


@endif
