<?php 
  /*echo "<pre>";
  print_r($products_data);
  die;*/
 ?>
 <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <link
      rel="stylesheet"
      href="https://site-assets.fontawesome.com/releases/v6.2.1/css/all.css"
    />
<style>
    @font-face {
        font-family: 'fonts/Roboto-Bold';
        src: url('fonts/Roboto-Bold.eot'); /* IE9 Compat Modes */
        src: url('fonts/Roboto-Bold.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('fonts/Roboto-Bold.woff2') format('woff2'), /* Super Modern Browsers */ url('fonts/Roboto-Bold.woff') format('woff'), /* Pretty Modern Browsers */ url('fonts/Roboto-Bold.ttf') format('truetype'), /* Safari, Android, iOS */ url('fonts/Roboto-Bold.svg#svgFontName') format('svg'); /* Legacy iOS */
    }



      /*<>========= End :  carousal css  =========<> */
        .carousel-inner > .item .carousel-caption {
        height: 350px;
        position: absolute;
        right: 15%;
        top:80%;
        left: -22%;
        z-index: 10;
        padding-top: 100px;
        padding-bottom: 20px;
        color: #fff;
        text-align: center;
        text-shadow:none !important;
      }
      .carousel-inner img {
        object-fit: cover;
        object-position: center center;
      }
      .item {
        width: 100%;
      }
      .carousel-caption .title-slider span {
        display: inline-block;
        color: #bb9870;
        position: relative;
      }
      .carousel-caption .title-slider span::before {
        content: "";
        width: 100%;
        height: 3px;
        background: #bb9870;
        position: absolute;
        bottom: 3px;
      }
      .carousel-caption .title-slider {
        color: #000;
        font-weight: 600;
        font-size: 70px;
        margin-bottom: 10px;
        margin-top: 0;
      }
      .description-slider {
        font-size: 20px;
        color: #323232;
        margin-bottom: 20px;
      }
      .carousel-control {
        width: 100px;
      }
       
      
      i.fa-thin.fa-arrow-left-long {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    top: 41%;
    border: 1px solid black;
    display: flex;
    justify-content: center;
    align-items: center;
    color:black;
    left: 25px;
    border-radius: 47px;
    width: 50px;
    height: 50px;
    transition: all 0.3s;
    }
     i.fa-thin.fa-arrow-right-long {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    top: 41%;
    border: 1px solid black;
    display: flex;
    justify-content: center;
    align-items: center;
    right: 25px;
    color:black;
    border-radius: 47px;
    width: 50px;
    height: 50px;
    transition: all 0.3s;
    }
      
      i.fa-thin.fa-arrow-right-long:hover {
        background-color: #bb9870;
      }
      i.fa-thin.fa-arrow-left-long:hover {
        background-color: #bb9870;
      }
      

      .slid_btn a {
        padding: 10px 40px 10px 15px !important;
        background: #bb9870 !important;
        border: 1px solid #bb9870 !important;
        border-radius: 0px;
        position: relative;
        transition: all 0.3s;
      }
      .slid_btn a:hover {
        background  : #323232 !important;
        border: 1px solid #323232 !important;
        border-radius: 0px;
      }

      i.fa-solid.fa-right-long{
        position:absolute;
        right:16px;
        top:13.5px;
      }
      .slid_btn a:hover i.fa-solid.fa-right-long {
        right:8px;
      }
     
    /*<>========= End :  carousal css  =========<> */

    /* i.fa-solid.fa-circle-chevron-left{
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    top: 41%;
    display: flex;
    justify-content: center;
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
    align-items: center;
    left: 0px;
    background: #bb9870;
    height: 80px;
    width: 41px;
}
i.fa-solid.fa-circle-chevron-right{
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    top: 41%;
    display: flex;
    justify-content: center;
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    align-items: center;
    right: 0px;
    background: #bb9870;
    height: 80px;
    width: 41px;
} */
/*-------- shipping ------ */
.ship_box{
  padding-bottom:15px;
}
.shipping_title {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 15px;
        border: 1px solid;
        border-style: solid;
        border-width: 1px;
        border-color: #d3d3d3;
        font-size: 18px;
        border-radius: 3px;
        margin-top: 0;
        font-weight: 700;
        margin-bottom: 0;
        width: 100%;
      }

      /*======= Books_Gallery======== */
      .col-md-4 figure {
        max-width: 100%;
      }
       figure:hover {
        animation-name: gamble;
        animation-duration: 1s;
        animation-duration: 1s;
        animation-iteration-count: 1;
        animation-timing-function: ease-in-out;
      }

      @keyframes gamble {
        0% {
          margin-left: 2%;
          width: 100%;
        }
        13% {
          margin-left: 1%;
          width: 100%;
        }

        25% {
          margin-left: 0%;
          width: 100%;
        }
        37% {
          margin-left: 1.5%;
          width: 100%;
        }
        50% {
          margin-left: 0%;
          width: 100%;
        }
        75% {
          margin-left: 1.5%;
          width: 100%;
        }
        87% {
          margin-left: 1.5%;
          width: 100%;
        }
        100% {
          margin-left: 0.5%;
          width: 100%;
        }
      }
      img.img-responsive {
        opacity: 1;
      }
      img.img-responsive:hover {
        opacity: 0.8;
      }

      .first_1 {
        width: 419px;
        height: 500px;
      }
      .first_2 {
        width: 419px;
        height: 234px;
        margin-bottom: 30px;
      }
      .first_3 {
        width: 419px;
        height: 234px;
        margin-bottom: 30px;
      }
      .clearfix {
        margin-top: 20px;
      }
      .col-md-4 {
        position: relative;
      }
      figcaption.first-cap {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
      figcaption.sce-cap {
        position: absolute;
        bottom: 58%;
        left: 30px;
      }

      figcaption.third-cap {
        position: absolute;
        bottom: 8%;
        left: 36px;
      }
      a.btn.btn-default {
        padding: 0 40px;
        border: none !important;
        border-radius: 1px;
        font-weight: 500;
        line-height: 40px;
        font-size: 14px;
        fill: #064532;
        color: rgb(255, 255, 255);
        background: rgb(187, 152, 112);
        transition: all 2s;
      }
      figure a.btn.btn-default:hover {
        color: #fff;
        background: #323232;
        border: none !important;
      }
      .modern {
        padding: 0 15px !important;
      }

      .pr-0 {
       padding-right: 0px !important;
      }
      .pl-0 {
       padding-left: 0px !important;
       }

      /* >======= End: Books Gallery ======> */

       /* <========== fixed_bg ===========> */
      .cancel_price {
        text-decoration: line-through;
        font-size: 26px;
        font-weight:600;
        color: #fff;
        margin-bottom: 10px;
      }
      .red_text {
        color: #bb9870;
        font-size: 30px;
        font-weight:600;
        margin-bottom: 10px;
        margin-bottom: 10px;
      }
      .bg_fixed {
        background: fixed;
        background-image: url(/assets/frontend/img/img4-5.webp);
        transition: all 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
        margin-top: 0px;
        margin: 60px 0px 80px 0px;
        padding: 80px 15px 80px 15px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .row_fixed {
        height: 560px;
        gap:80px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .side_img img{
        display:block;
        margin:auto;
      }
      
      .section-bg {
        height: 570px;
      }
      .side_text_heading {
        color: #ffffff;
        font-weight: 700;
        font-size: 36px;
        font-weight: 400;
        font-style: italic;
        margin-bottom: 20px;
        margin-top: 0;
      }
      .framed_img {
        width: 190px;
        margin-top: 22px;

      }
      .content_division {
        display: flex;
        align-items: flex-start;
        gap: 30px;
      }

      .side_detail h3 {
        padding-bottom: 0px !important;
        font-weight: 600;
        color: white;
        font-size: 22px;
        margin-bottom:3px;
      }
      .side_detail a {
        font-size:16px;
        color:#fff;
        margin-bottom:7px;
      }
      .side_detail ul {
        padding:10px 16px;
      }
      .side_detail h3 {
        padding-bottom: 0px !important;
        font-weight: 600;
        color: white;
        font-size: 22px;
      }
      .side_detail ul li {
        margin-top: 5px;
        color: white;
      }
      .side_content .btn.btn-default {
        margin-top: 30px;
        background: transparent;
        font-size: 16px;
        font-weight: 500;
        line-height: 36px;
        border-style: solid;
        border-width: 2px 2px 2px 2px;
        border-radius:0px !important;
        border-color: #ffffff;
        padding: 0px 15px 2px 15px;
        color: #ffffff;
        transition: all 2s;
      }
      .side_content .btn.btn-default:hover {
        color: white;
        background: #323232;
        border: 2px solid #323232;
      }
      .glyphicon-arrow-right {
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: "Glyphicons Halflings";
        font-style: normal;
        width: 30px;
        font-size: unset;
        font-weight: lighter;
        line-height: 2;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        transition: all 3s;
      }
      .btn.btn-default:hover .glyphicon-arrow-right {
        position: relative;
        top: 1px;
        left: 8px;
      }
      .footer_1 a:hover {
      color: #bb9870 !important;
      text-underline-offset: 5px;
      padding-left: 15px;
      }

       /* <========== End: fixed_bg ===========> */


       /* <========= Stsrt: static_cheap_section ========> */

      .static_cheap_section {
        background-image: url(/assets/frontend/img/img4-8.webp);
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .elementor-bar {
        transition: all 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
        margin-top: 0px;
        margin-bottom: 75px;
        padding: 80px 15px 80px 15px;
      }
      .elementor-clearfix::after {
        content: "";
        display: block;
        clear: both;
        width: 0;
        height: 0;
      }
      .elementor-clearfix {
        font-family:"roboto" !important;
        color: #bb9870;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0px 0px 15px 0px;
      }
      .elementor-widget-container {
        margin: 0px 0px 40px 0px;
      }

      .elementor-heading-title {
        font-weight: 600;
        color: #323232;
        font-size: 40px;
        line-height: 50px;
      }
      .elementor-divider-separator {
        border-top: 3px solid #323232;
        width: 60px;
        height: 20px;
        display: flex;
        margin: 0;
        direction: ltr;
      }
      .elementor-image {
        text-align: right;
      }
      .elementor-text{
        font-size:16px;
      }
      .elementor-button {
        padding: 10px 25px;
        text-decoration: none !important;
        color: white;
        font-size: 16px;
        font-weight: 600;
        background: rgb(187, 152, 112);
        border-radius: 0px !important;
        border: 1px solid rgb(187, 152, 112);
        transition: all 1s;
      }
      .elementor-button:hover {
        font-size: 16px;
        line-height: 38px;
        color:white;
        background: #323232;
        border: 1px solid #323232;
      }
      /* <========== End: static_cheap_section ==========> */
      
       /* >-=-=-=-=-=-testimonial=-=-=-=-=-=-> */
      /* <-------swiper css -------> */
      .swiper {
        width: 100%;
        height: 100%;
        margin-bottom:50px;
      }

      .swiper-slide {
        flex-direction: column !important;
        text-align: center;
        font-size: 15px;
        background: #fff;
        /* Center slide text vertically */
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100px;
        height: 100px;
        object-fit: cover;
      }
      .swiper-pagination {
        position: absolute;
        top: 185px !important;
        text-align: center;
        transition: 0.3s opacity;
        transform: translate3d(46, 0, 36);
        z-index: 10;
      }
      .swiper-pagination-clickable .swiper-pagination-bullet {
        cursor: pointer;
        height: 14px;
        width: 12px;
        background: rgb(187, 152, 112);
      }
      /* <-------swiper end--------> */

      .item-image {
        width: 100% ;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 180px;
        flex: 0 0 180px;
        padding: 30px 30px 30px 30px;
        margin: 0px 0px 25px 0px;
      }
      .item-image img {
        height: 120px;
        max-width: 100%;
        border: none;
        width: 180px;
        flex: 0 0 180px;
        border-radius: 50% 50% 50% 50%;
      }
      .item-image {
        position: relative;
        background: url(assets/frontend/img/bg-author.webp) no-repeat;
        background-position: bottom;
      }
      /* .content {
        width: 100%;
      } */

      .item-content.image-position-top {
        flex-wrap: wrap;
        justify-content: center;
      }
      .item-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 0px;
        margin-top: 0;
      }
      .item-title span {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 0px;
        margin-top: 0;
        color: #000;
      }
      .item-count {
        font-size: 14px;
      }
      .row {
        margin-right: 0px !important;
        margin-left: 0px !important;
      }

      .testimonial_heading {
        font-weight: 700;
        font-size: 35px !important;
        text-align: center;
        margin-bottom: 25px;
      }
     

       /* <-----======End : Books Hover Effecct Css====----> */

      .box {
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
      }
      .box:hover {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      }
      .box img {
        width: 100%;
        height: auto;
        transition: all 0.3s ease-in-out;
      }
      
      .box .box-content {
        color: #fff;
        background:#323232;
        /* background: linear-gradient(
          109.6deg,
          rgba(144, 109, 50, 0.8) 11.2%,
          rgba(198, 153, 77, 0.8) 100.2%
        ); */
        font-size: 18px;
        font-weight: 700;
        width: 100%;
        padding: 10px 0 10px;
        transform: translateX(-50%);
        position: absolute;
        bottom: -50px;
        left: 50%;
        z-index: 2;
        transition: all 0.3s ease-in-out;
      }
      .box .box-content:hover {
        
        background: linear-gradient(
          109.6deg,
          rgba(144, 109, 50, 0.8) 11.2%,
          rgba(198, 153, 77, 0.8) 100.2%
        );
        
      }
      .box:hover .box-content {
        bottom: 0px;

      }
      .box .title {
        font-size: 22px;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0 0 2px;
      }
      .box .post {
        font-size: 14px;
        font-weight: 400;
        letter-spacing: 1px;
        text-transform: capitalize;
        margin: 0 0 10px;
        display: block;
      }
      .box .icon {
        padding: 0 !important;
        display: flex;
        gap:50PX;
        justify-content: space-evenly;
        margin: 0;
        list-style: none;
        transition: all 0.4s ease-out;
      }
      .box .icon li {
        margin: 0 3px;
        display: inline-block;
      }
      
      .box .icon li i{
        color:white;
        position: relative;
        font-size: 16px;
        line-height: 31px;
        height:30px;
        width:30px;
        display: block;
        transition: all 0.3s;

      }
      .box .icon li a{
        text-decoration:none;
      }
      
      /* a.brder::after {
        content: "";
        border-right: 1px solid black;
        position: absolute;
        height: 32px;
        left: 94px;
        top:9px;
      } */
      .box .icon li i:hover {
        background:#bb9870;
        box-shadow: 0 0 5px #fff;
      }

      .product-col.list .image {
        overflow: hidden;
      }
      .best_seller_icon {
       display: flex;
       align-items: center;
       gap: 5px;
      }
      .top_banner{
        margin-top:7px;
        position: absolute;
        top:0px;
        display:flex;
        gap:10.5rem;
        align-items:center;
        padding:0px 10px;
        justify-content:space-between !important;
      }
      .top_banner button{
        background:#fff;
        border-radius:20px;
        padding: 3px 6px;
        border:none;
        
      }
      .top_banner i{
        color:#000;
        font-size:14px;
      }
      .top_banner span{
        color:#fff;
        font-size:14px;
        background:red;
        padding: 1px 7px;

      }
      .rating_viewed{
        text-align:center;

      }
      .rating_viewed i.fa-duotone.fa-star {
       font-size: 12px;
       opacity: .3;

      }
      @media only screen and (max-width: 990px) {
        .box {
          margin: 0 0 30px;
        }
      }
      /* <-----======End : Books Hover Effecct Css====----> */

      @media only screen and (max-width: 960px) {
        
        .carousel-inner img {
          min-height: 500px;
          object-position: center left;
        }
        .row_fixed {
          height: 100%;
          width: 100%;
          display: block;
        }
        .row {
          margin-right: 0px;
          margin-left: 0px;
        }
        .pr-0 {
       padding-right:15px !important;
      }
      .pl-0 {
       padding-left: 15px !important;
       }

      }

      @media only screen and (max-width: 767px) {

         #myCarousel .carousel-inner .item img {
         width: 100%;
         object-position: center left;
         object-fit: cover;
         height: 500px;
         }

          i.fa-thin.fa-arrow-left-long {
          left: 10px;
          width: 50px;
          height: 50px;
        
          }
        i.fa-thin.fa-arrow-right-long {
          right: 10px;
          width: 50px;
          height: 50px;
        }
        .carousel-inner > .item .carousel-caption {
       
        right: 15%;
        top:80%;
        left: 0%;
        z-index: 10;
        padding-top: 100px;
        padding-bottom: 20px;
       
      }
        .first_1 {
          width: 100%;
          height: 500px;
          margin-bottom:15px;
          
        }
        .first_2 {
          width: 100%;
          height: 234px;
          margin-bottom: 30px;
        }
        .first_3 {
          width: 100%;
          height: 234px;
          margin-bottom: 30px;
        }
        .swiper {
        width: 100% !important;
        }
        .swiper-wrapper {
          width: 100% !important;
        }
        .item-image {
          width: 180px !important;
          
        }
        .item-content.image-position-top {
          width: auto !important;
        }

        
       
        
      }

      @media only screen and (max-width: 600px) {

        .side_text_heading {
         margin-top: 25px;
         }
        .elementor-image img {
          text-align: center;
          width: 100%;
        }
        .bg_fixed .container-fluid {
          padding-left: 30px;
        }
    
        .clearfix {
          margin-top: 20px;
        }
        .col-md-4 {
          position: relative;
        }
        .swiper {
        width: 100% !important;
        }
        .swiper-wrapper {
          width: 100% !important;
        }
        .item-image {
          width: 180px !important;
          
        }
        .item-content.image-position-top {
          width: auto !important;
        }
      }


</style>

 <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

<div class="col-xs-12 no-padding">
    <!-- <div class="">
        <div class="row no-padding">
            <div class="col-sm-12 no-padding"> -->
                <div class="container no-padding">
                    <div class=" myslider no-padding">
                        <div id="myCarousel" class="carousel slide hght_slider" data-ride="carousel">
                            <div class="carousel-inner hght_slider" role="listbox">
                                <div class="item active">
                                    <img src="assets/frontend/img/slider1-1.webp" class="slider_img" align="right" 
                                     onclick="window.location = '<?php echo base_url('products') ?>'">
                                    <div class="carousel-caption">
                                      <h2 class="title-slider">
                                        Biggest <span>bookstore</span><br />
                                        in Europe
                                      </h2>
                                      <div class="description-slider">
                                        We deliver books all over the world 10,000+ books in stock
                                      </div>
                                      <div class="slid_btn">
                                        <a href="<?php echo base_url("products"); ?>" type="button" class="btn btn-warning slid_btn"
                                          >CHECK OUR BESTSELLERS<i class="fa-solid fa-right-long"></i
                                        ></a>
                                      </div>
                                    </div>
                                    
                                </div>
                                <div class="item">
                                    <img src="assets/frontend/img/slider1-2.webp" class="slider_img" align="right" 
                                     onclick="window.location = '<?php echo base_url('products') ?>'">
                                      <div class="carousel-caption">
                                        <h2 class="title-slider">
                                          Bestselling <br /><span>Fiction</span>
                                          Books
                                        </h2>
                                        <div class="description-slider">
                                          <!-- Over 120,000 Trustpilot reviews -->
                                        </div>
                                        <div class="slid_btn">
                                          <a href="<?php echo base_url("products"); ?>" type="button" class="btn btn-warning"
                                            >CHECK OUR BESTSELLERS<i class="fa-solid fa-right-long"></i
                                          ></a>
                                        </div>
                                      </div>
                                </div>
                                <div class="item">
                                    <img src="assets/frontend/img/slider1-3.webp" class="slider_img" align="right" 
                                     onclick="window.location = '<?php echo base_url('products') ?>'">
                                    <div class="carousel-caption">
                                      <h2 class="title-slider">
                                        Meet our<br />
                                       <span> Booksellers</span>
                                      </h2>
                                      <div class="description-slider">
                                        CONNECT WITH OUR BOOKSELLERS
                                      </div>
                                      <div class="slid_btn">
                                        <a href="<?php echo base_url("stores"); ?>" type="button" class="btn btn-warning"
                                          >CHECK OUR BESTSELLERS<i class="fa-solid fa-right-long"></i
                                        ></a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <a data-slide="prev" href="#myCarousel" class="left carousel-control">
                                <!-- <span class="icon-prev"><img src="assets/frontend/img/arrow_left.png" alt=""/></span> -->
                                <i class="fa-thin fa-arrow-left-long"></i>

                            </a>
                            <a data-slide="next" href="#myCarousel" class="right carousel-control">
                                <!-- <span class="icon-next"><img src="assets/frontend/img/arrow_right.png" alt=""/></span> -->
                                <i class="fa-thin fa-arrow-right-long"></i>


                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-12" style="display:none;">
                <?php $referUserLink = $this->session->userdata('logged_in') ? base_url('refer_friend'):base_url('login'); ?>
                <img src="assets/frontend/img/s_side.jpg" class="img-responsive imgslidlft"  alt="">
            </div>
        <!-- </div>
    </div>
</div> -->
<div class="clear35"></div>
<div class="clear20"></div>
<!-- ----shipping ------- -->

<div class="container">
      <div class="row">
        <div class="col-md-4 pl-0 ship_box">
          <h4 class="shipping_title" > Bestselling books from all over the World </h4>
        </div>
        <div class="col-md-4 ship_box">
          <h4 class="shipping_title">Over 7 million books Listed</h4>
        </div>
        <div class="col-md-4 pr-0 ship_box">
          <h4 class="shipping_title " > 100% secure payment</h4>
        </div>
      </div>
    </div>

<!-- =======end ========= -->
<!-- ------image-gallery ------- -->

<div class="container">
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-4 col-sm-6 pl-0">
          <figure>
            <a href="">
              <img
                class="first_1 img-responsive"
                src="assets/frontend/img/img4-7 (1).webp"
                alt=""
              />
            </a>
            <figcaption class="first-cap">
              <a class="btn btn-default" href="#">ROMANCE</a>
            </figcaption>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6">
          <figure>
            <a href="">
              <img
                class="first_2 img-responsive"
                src="assets/frontend/img/img4-10.webp"
                alt=""
              />
            </a>
            <figcaption class="sce-cap">
              <a class="btn btn-default" href="#">FANTASY</a>
            </figcaption>
          </figure>
          <figure>
            <a href="">
              <img
                class="first_2 img-responsive"
                src="assets/frontend/img/img4-11.webp"
                alt=""
              />
            </a>
            <figcaption class="third-cap">
              <a class="btn btn-default modern" href="#">MODERN FICTION</a>
            </figcaption>
          </figure>
        </div>
        <div class="col-md-4 col-sm-6 pr-0">
          <figure>
            <a href="">
              <img
                class="first_3 img-responsive"
                src="assets/frontend/img/img4-12.webp"
                alt=""
              />
            </a>
            <figcaption class="sce-cap">
              <a class="btn btn-default" href="#">ADVENTURE</a>
            </figcaption>
          </figure>
          <figure>
            <a href="">
              <img
                class="first_3 img-responsive"
                src="assets/frontend/img/img4-13.webp"
                alt=""
              />
            </a>
            <figcaption class="third-cap">
              <a class="btn btn-default" href="#">RELIGION</a>
            </figcaption>
          </figure>
        </div>
      </div>
    </div>
<!-- ======== End ======== -->



<div class="clear20"></div>

<div class="col-xs-12 no-padding">
    <div class="">
        <div class="row no-padding">
            <div class="hdg_bg"><span title="Best sellers"><?php //echo getlanguage('Best sellers');?>Bookumbrella Bestselling books</span><span class="pull-right"><a href="<?php echo base_url('products');?>" class=" btn btn-default" title="view all"><?php echo getlanguage('view_all');?></a></span></div>
            
        </div>
    </div>
</div>

<div class="clear20"></div>

<div class="col-xs-12 no-padding">
<div class="">

    <div class="row no-padding home-prod-data-cont">
        <?php 

       
        if ($most_sold!='nothing') { $i = 0; ?>
            <?php foreach ($most_sold as $product) { $i++; ?>
                <!-- <a
                        href="<?php echo base_url('product/detail') . "/" . encode_url($product['product_id']); ?>"> -->
                    <div class="product-col list clearfix col-sm-2 product_col_sepration">
                        <div class="image col-sm-12 image_product"><img class="img_height"
                                                                        alt="product"
                                                                        src="<?php echo base_url(''); ?><?php echo $product['image'] ?>">
                        </div>
                        <div class="clearfix"></div>
                        <div class="caption col-sm-12">
                            <h4><?php echo $product['title']; ?></h4>
                            <?php foreach($author as $aut){ if($product["author"] == $aut->id){ ?>
                            <p class="author">By: <?php echo $aut->author_name; ?>   </p>
                          <?php }} ?>


                            <div class="price no-padding" style="margin:0; padding:0px;">
                                <p class="price-tax" style=""><span
                                            class="price">$<?php echo $product['buy_price'] ? $product['buy_price'] : $product['buy_price']; ?></span>
                                </p>
                            </div>
                            <div class="price no-padding" style="margin:0; padding:0px;">

                                <a class="btn btn-cart btn-block btncatg" type="button"  href="<?php echo base_url('product/detail/'.encode_url($product['product_id']));?>" title="Product Details">
                                    Details

                                </a>
                            </div>

                        </div>
                    </div>
                </a>
            <?php }
        } else {
            echo '<div class="alert alert-danger">Sorry ! No product found</div>';
        }
        ?>
    </div>

    </div>



    <?php /*?><div class="">
        <div class="row no-padding">
            <?php if($stores_data) { ?>
                <?php for($i=0; $i< count($stores_data); $i++){ ?>
                    <div class="view_box">

                        <?php if($stores_data[$i]['image_url'] !=''){
                            $img = base_url('uploads/img_gallery/store_images').'/'.$stores_data[$i]['image_url'];
                        } else {
                            $img = base_url('uploads/img_gallery/store_images/default-store-350x350.jpg');
                        }?>

                        <div class="pdg_15 align_img"><img alt="Store" src="<?php echo $img; ?>"></div>
                        <div class="view_box_wt">
                            <h2 class="limit-product-title-to-single-line"><?php echo $stores_data[$i]['name']; ?></h2>
                            <div class="limit-mini-thumb-desc">
                                <?php echo $stores_data[$i]['short_description']; ?>
                            </div>
                            <div class="clear10"></div>
                            <a href="<?php echo base_url('products')."?user_id=".$stores_data[$i]['user_id']; ?>" class="btn btn-success" >View Books</a>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
      

    </div><?php */?>
</div>




<div class="clear20"></div>



<div class="clear10"></div>

<div class="col-xs-12 no-padding">
    <div class="">
        <div class="row no-padding">
            <div class="hdg_bg" style><span title="Trending on bookumbrella"><?php // echo getlanguage('Trending on bookumbrella');?>Trending on Bookumbrella</span><span class="pull-right"><a href="<?php echo base_url('products');?>" class=" btn btn-default" title="view all"><?php echo getlanguage('view_all');?></a></span></div>
            
        </div
    </div>
</div>

<div class="clear20"></div>

<div class="col-xs-12 no-padding">
    
    <div class="container">
        
        <div class="row no-padding home-prod-data-cont">
            <?php if ($products_data) { $i = 0; ?>
                    <?php foreach ($products_data as $product) { 
$actual_product = $this->comman_model->get('seller_products', array('product_id' => $product['product_id']));
                        $i++; 
            
            if($actual_product){


                        ?>
                        <div class="product-col list clearfix col-sm-3 product_col_sepration">
                        <a 
                                   href="<?php echo base_url('product/detail') . "/" . 
                                   encode_url($product['product_id']); ?>">
                                <div class="image col-sm-12 image_product  box">
                                  <div class="top_banner">
                                    <span> -10%</span>
                                 <button><i class="fa-thin fa-heart fa-lg"></i></button>                        
                                  </div>
                                  <img class="img_height"  alt="product" 
                                  src="<?php echo base_url(''); ?><?php echo $product['image'] ?>">
                                  

                                </a>
                                <div class="box-content">
                                   <ul class="icon">
                                     <li>
                                       <a href="<?php echo base_url('product/detail/'.encode_url($product['product_id']));?>" class="brder">
                                         <i class="fa-solid fa-eye"></i>
                                       </a>
                                     </li>
                                     <!-- <li>
                                       <a href="#"> <i class="fa-light fa-bag-shopping"></i></a>
                                     </li> -->
                                   </ul>
                                 </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="caption col-sm-12">
                                  
                                    <h4><?php echo $product['title']; ?></h4>
                                <p class="author"> By: <?php if(!empty($author)){ foreach ($author as $aut){
                                      if($aut->id == $product["author"]){echo $aut->author_name;}}}?> </p>
             
         

                               <div class="price no-padding" style="margin:0; padding:0px;">
                                  <p class="price-tax" style=" "><span
                                          class="price">$<?php echo $product['buy_price'] ? $product['buy_price'] : $product['buy_price']; ?></span>
                                  </p>
                                </div>
                            <!-- <div class="price no-padding" style="margin:0; padding:0px;">
                            
                            <a class="btn btn-cart btn-block btncatg" type="button"  href="<?php echo base_url('product/detail/'.encode_url($product['product_id']));?>" title="Product Details">
                                 Details
                                 
                             </a>
                             </div> -->
                             
                                </div>
                            </div>
                        
                    <?php }  
                }
                } else {
                    echo '<div class="alert alert-danger">Sorry ! No product found</div>';
                }
            ?>
        </div>

    </div>

<?php 
  if(!empty($products_data)){
  foreach ($products_data as $product) { 
      if($product["month_of_the_book"] == 1 ){
 ?>

<div class="clear10"></div>
 <!-- ========== Section_Fixed_bg ========== -->
    <div class="section_bg">
      <div class="bg_fixed">
        <div class="container-fluid">
          <div class="row row_fixed">
            <div class="col-md-6">
              <div class="side_img">
                <figure>
                  <a href="<?php echo base_url('product/detail/'.encode_url($product['product_id']));?>">
                    <img class="img-responsive" src="<?php echo $product["image"] ?>" alt="" height="466px"
                      width="350px"/>
                  </a>
                </figure>
              </div>
            </div>
            <div class="col-md-6">
              <div class="side_content">
                <h3 class="side_text_heading">Book of the Month</h3>
                <div class="content_division">
                  <div class="framed_img">
                    <img
                      src="/assets/frontend/img/img3-2.png"
                      alt=""
                      class="img-responsive"
                    />
                  </div>
                  <div class="side_detail">
                    <h3 style="color: #fff"> <?php  echo $product["title"]; ?></h3>
                    <a > By : <?php if(!empty($author)){ foreach($author as $auth){
                                      if($auth->id == $product["author"]){
                                        echo $auth->author_name;
                                      }}} ?></a>
                    <!--  -->
                    <h4 class="book_pri">
                      <!-- <span class="cancel_price">$<?php echo $product["rent_price"]; ?></span> -->
                      <span class="red_text">$<?php echo $product["buy_price"]; ?></span>
                    </h4>
                    <!-- <ul>
                      <li>For kids</li>
                      <li>First published in 2014</li>
                      <li>Copyright by Wpbingo</li>
                    </ul> -->
                  </div>
                </div>
                <a href="<?php echo base_url('product/detail/'.encode_url($product['product_id']));?>"><button class="btn btn-default">
                  View Details <i class="glyphicon glyphicon-arrow-right"></i>
                </button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } } }
  ?>

    <!-- End: Fixed_bg -->

    <!-- =========== Start: Static_Cheap_Section =========== -->
    <div class="static_cheap_section elementor-bar">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <p class="elementor-clearfix">Cheap Books, Fantastic Choice</p>
            <div class="elementor-widget-container">
              <h2 class="elementor-heading-title">
                Welcome to the 
                <br />
                World of Bookumbrella
              </h2>
            </div>
            <span class="elementor-divider-separator"> </span>
            <div class="elementor-widget-container">
              <div class="elementor-text">
                <p>
                 If you’re looking for great value books, then Bookumbrella is the place for you. 
                  As you may already know, we aren’t like other online book stores.
                  For starters, we don’t believe that books should only be read once, or have a single owner. 
                  Literature should endure and be continually recycled, which is why we help millions of used books 
                  find new homes every year.
                </p>
              </div>
            </div>
            <div class="elementor-widget-container">
              <div class="elementor-button-wrapper">
                <a
                  href="#"
                  class=" elementor-button"
                  role="button"
                >
                  <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-text">Learn more</span>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="elementor-image">
              <img
                width="496"
                height="481"
                src="/assets/frontend/img/img4-7.png"
                class="attachment-full size-full"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--========= End: Static_Cheap_Sectin ======= -->
<div class="col-xs-12">
    <div class="">
        <div class="row no-padding">

            <div class="col-sm-4 col-xs-12 pdg_leftnone">
                <div class="gurnate_box" >
                    <h2 title="Safisfaction 100% guranteed"><?php echo getlanguage('satisfaction');?></h2>

                    <h3>100% <?php echo getlanguage('guranteed');?></h3>

                    <div class="clear20"></div>
                    <?php 
                   $data = get('static_page',array('slug'=>'satisfaction_guranteed'));
                   if($data) {
                   $string = $data[0]['description'];
                   if(strlen($string) > 170)
                   echo $stringCut = substr($string, 0, 170);
                   ?>
                    <a href="<?php echo base_url('pages').'/'.$data[0]['slug'];?>">READ MORE</a>
                   <?php } ?>
                </div>
            </div>


            <div class="col-sm-4 col-xs-12">
                <div class="gurnate_box">
                    <div class="pull-left"><img src="assets/frontend/img/shipping.png" alt=""></div>

                    <div class="pull-left" style="margin-left:20px;">
                        <h2 title="Free shipping"><?php echo getlanguage('free');?> </h2>
                        <h3><?php echo getlanguage('shipping');?></h3></div>
                    <div class="clear20"></div>
                   <?php 
                   $data = get('static_page',array('slug'=>'satisfaction_guranteed'));
                   if($data) {
                   $string = $data[0]['description'];
                   if(strlen($string) > 165)
                   echo $stringCut = substr($string, 0, 165);
                   ?>
                    <a href="<?php echo base_url('pages').'/'.$data[0]['slug'];?>">READ MORE</a>
                   <?php } ?>
                </div>
            </div>


            <div class="col-sm-4 col-xs-12 pdg_rightnone">
                <div class="gurnate_box">
                    <div class="pull-left"><img src="assets/frontend/img/returen.png" alt=""></div>
                    <div class="pull-left" style="margin-left:20px;">
                        <h2 title="14 day Easy return">14 <?php echo getlanguage('day');?></h2>
                        <h3><?php echo getlanguage('easy_return');?></h3></div>
                    <div class="clear20"></div>
                   <?php 
                   $data = get('static_page',array('slug'=>'satisfaction_guranteed'));
                   if($data) {
                   $string = $data[0]['description'];
                   if(strlen($string) > 170)
                   echo $stringCut = substr($string, 0, 170);
                   ?>
                    <a href="<?php echo base_url('pages').'/'.$data[0]['slug'];?>">READ MORE</a>
                   <?php } ?>
                </div>
            </div>


        </div>
    </div>
</div>


<div class="clear20"></div>
<?php /*?><div class="col-xs-12 no-padding">
    <div class="container">
        <div class="row no-padding">

            <div class="info_box mrg_left19"><img src="assets/frontend/img/help.png" alt=""> <span title="FAQ"><?php echo getlanguage('frequently_asked_questions');?> </span></div>
            <div class="info_box"><img src="assets/frontend/img/info.png" alt=""> <span title="About us"><?php echo getlanguage('about_us');?></span></div>
            <div class="info_box"><img src="assets/frontend/img/email.png" alt=""> <span title="One-to-one contact"><?php echo getlanguage('One-to-one_contact_center');?></span></div>
            <div class="info_box"><img src="assets/frontend/img/mble_icon.png" alt=""> <span title="About us"><?php echo getlanguage('about_us');?></span></div>
            <div class="info_box"><img src="assets/frontend/img/other.png" alt=""> <span title="About us"><?php echo getlanguage('about_us');?></span></div>


        </div>
    </div>
</div><?php */?>

<div class="clear10"></div>

  <!-- ========== Testimonial (featured_author_section) ========== -->
    <span class="pull-right"><a href="<?php echo base_url('author');?>" class=" btn btn-default" title="view all"><?php echo getlanguage('view_all');?></a></span>
    <div class="featured_author_section">
      <div class="container_fluid">
        <h1 class="testimonial_heading text-center">Featured Author</h1>
        <!-- Swiper -->
        <div class="swiper mySwiper " style="width: 100% !important;height: 100%;">
          <div class="swiper-wrapper">
            <?php if(!empty($author)){ foreach($author as $auth){
                  if($auth->featured == 1){
            ?>
            <div class="swiper-slide">
              <div class="item-content image-position-top">
                <div class="col-md-2 item-image">
                  <a href="products?search=<?php echo $auth->author_name; ?>&cat=keyword"
                    ><img width="80px" src="<?php echo base_url("uploads/author_gallery/".$auth->image) ?>" alt="Not Found"
                  /></a>
                </div>
              </div>
              <div class="content">
                <h2 class="item-title">
                  <a href="products?search=<?php echo $auth->author_name; ?>&cat=keyword" tabindex="0"><span><?php echo $auth->author_name; ?></span></a>
                </h2>
                <?php
                    foreach($author_published as $count){ 
                if($auth->id == $count->author){ ?>
                <div class="item-count"><?php echo  $count->total_author ?><span> Published Book</span></div>
              <?php } }?>
              </div>
            </div>
          <?php }}} ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 5,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        breakpoints: {
          "@0.00": {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          "@0.75": {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          "@1.00": {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          "@1.50": {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          "@1.75": {
            slidesPerView: 4,
            spaceBetween: 10,
          },

          "@2.00": {
            slidesPerView: 5,
            spaceBetween: 10,
          },
          "@2.25": {
            slidesPerView: 6,
            spaceBetween: 10,
          },
        },
      });
    </script>

    <!-- ========== End: Testimonial (featured_author_section) ========== -->