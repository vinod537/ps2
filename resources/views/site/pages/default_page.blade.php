@extends('site.layouts.app')

@section('content')
    <style>
        @media screen and (min-width:1100px) and (max-width:1550px) {
            .left__cont ul li {
                padding-left: 0px;
                margin-left: -20px;
            }

            .left__cont {
                padding-top: 34px;
                width: 92% !important;
            }

            #headdf .container {
                width: 98%;
                max-width: 98%;
            }

            .col-md-2asfasf .search-form.d__rtt.new_drtt {
                margin-top: -33px !important;
            }

            .sg-menu .navbar-nav li a {
                color: #222;
                display: block;
                font-weight: 400;
                padding: 9px 0 12px 1px;
                margin-right: 15px !important;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }


            .servil__list li.para_list {
                box-shadow: none;
                border: bisque;
                width: 46% !important;
                background: #f0cec5;
            }

            .servil__list li {
                list-style: none;
                width: 22% !important;
                /* display: inline-block; */
                border: 1px solid #00000026;
                height: 103px;
                float: left;
                padding: 14px;
                margin: 11px;
                color: #000;
                border-radius: 7px;
                text-align: left;
                box-shadow: 0 0 5px 2px #00000017;
                font-size: 13px;
            }

            .left__cont h3 {
                color: #073C65;
                text-transform: uppercase;
                font-size: 56px !important;
                margin-bottom: 37px;
            }

            .search__click_09 {
                /* position: relative; */
                /* z-index: 9999; */
                cursor: pointer;
                margin-right: 42px !important;
            }
        }

        .col-md-2asfasf .search-form.d__rtt {
            width: 149px !important;
            right: 15px !important;
            margin-top: -33px;
            position: absolute;
            z-index: 9999;
        }

        .khe__team {
            position: relative;
            width: 200px;
            height: 200px;
            float: left;
            margin-right: 10px;
            padding-top: 11px;
            margin-left: 27px;
        }

        .khe__team .new__info {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #fff !important;
            color: #000;
            margin-bottom: 29px;
            font-family: sans-serif;
            opacity: 0;
            visibility: hidden;
            -webkit-transition: visibility 0s, opacity 0.5s linear;
            transition: visibility 0s, opacity 0.5s linear;
            margin-left: 68px !important;
            border-radius: 5px;
        }

        .khe__team:hover {

            cursor: pointer;
        }

        .khe__team:hover .new__info {
            width: 300px;
            padding: 8px 15px;
            visibility: visible;
            opacity: 1;
            z-index: 9999;
            position: relative;
            top: -140px;
            left: 13px;
            box-shadow: 2px 0 10px 4px #00000073;
        }

        .goal h3 {
            color: #073C65;
            padding-top: 30px;
            padding-bottom: 10px;
        }

        .footer-content .sg-socail li a:hover {
            color: #fff;
            background-color: #073c65;
        }

        .fa.fa-linkedin {
            position: relative;
            top: -2px;
            left: 2px;
        }

        .fa.fa-twitter {
            position: relative;
            top: -2px;
            left: 2px;
        }

        .goal p {
            font-size: 13px;
            font-weight: normal;
            line-height: 25px;
            letter-spacing: 0.5px;
        }

        ..history p {
            font-size: 13px;
            font-weight: normal;
            line-height: 25px;
            letter-spacing: 0.5px;
        }

        .history h3 {
            color: #000;
            padding-top: 30px;
            padding-bottom: 10px;
        }

        .history_goals {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .khe__team h4 {
            font-size: 18px;
            color: #000;
        }

        .our_team {
            padding-top: 60px;
            padding-bottom: 0px;
        }

        .khe__team img::before {
            border-radius: 50%;
            width: 170px;
            height: 170px;
            box-shadow: 2px 3px 6px 2px #0006;
            margin-bottom: 12px;
        }


        .our_team .col-md-22 {
            width: 20%;
        }

        .khe__team h4 {
            padding-top: 20px;

        }

        .servil__list li {
            list-style: none;
            width: 22%;
            /* display: inline-block; */
            border: 1px solid #00000026;
            height: 103px;
            float: left;
            padding: 14px;
            margin: 11px;
            color: #000;
            border-radius: 7px;
            text-align: left;
            box-shadow: 0 0 5px 2px #00000017;
            font-size: 13px;
        }

        color: #000;
        font-size: 20px;
        }

        .our_team {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .about__banner__s {
            padding-top: 113px;
        }

        .left__cont {
            padding-top: 62px;
            width: 89%;
        }

        .left__cont p {
            font-size: 13px;
            font-weight: normal;
            line-height: 25px;
            letter-spacing: 0.5px;
        }

        .left__cont {
            padding-top: 34px;
            width: 80%;
        }

        .khe__team p {
            font-size: 14px !important;
            margin-top: -3px;
        }

        .left__cont h3 {
            color: #000;
            text-transform: uppercase;
            font-size: 71px;
            margin-bottom: 37px;
        }

        .khe__team {
            text-align: center;
        }

        .about__img_08 iframe {
            border-radius: 11px;
            box-shadow: 0 0 8px 2px #00000069;
        }

        .about__banner__s .container {
            width: 78%;
        }

        .khe__team img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            box-shadow: 2px 3px 6px 2px #0006;
        }

        .about__banner__s {
            padding-top: 140px;
            padding-bottom: 85px;
        }

        .accordion__0-988 .container {
            width: 78%;
        }

        .accordion__0-988 {
            padding-bottom: 73px;
        }

        .s__0f {
            text-transform: uppercase;
            color: #000;
            text-align: center;
            font-size: 61px;
            margin-bottom: 51px;
        }

        .mb-0 .fa.fa-angle-down.rotate-icon {
            float: right;
        }

        .mb-0 {
            font-size: 16px;
            letter-spacing: 0.5px;
            color: #000;
        }

        .container {
            width: 78%;
        }

        .services__009 {
            background: #fff;
            padding-top: 54px;
            padding-bottom: 44px;
        }

        .c__heading_0s {
            text-align: center;
            margin-bottom: 49px;
        }

        .c__heading_0s h3 {
            color: #000;
            text-transform: uppercase;
            font-size: 36px;
            width: 61%;
            margin-left: auto;
            margin-right: auto;
        }

        .servil__list li {
            list-style: none;
            width: 23%;
            /* display: inline-block; */
            border: 1px solid #00000026;
            height: 103px;
            float: left;
            padding: 14px;
            margin: 11px;
            color: #000;
            border-radius: 7px;
            text-align: left;
            box-shadow: 0 0 5px 2px #00000017;
            font-size: 13px;
        }

        ul.social_meda .fa.fa-twitter {
            color: #1DA1F2;
        }

        ul.social_meda .fa.fa-linkedin {
            color: #0e76a8;
        }

        .fa.fa-check-circle {
            font-size: 20px;
            margin-bottom: 5px;
            color: #697aac;
        }

        .social_meda {
            text-align: center;
            margin-left: -30px;
        }

        .accordion__0-988 {
            padding-top: 38px;
        }

        ul.social_meda li {
            list-style: none;
            display: inline-block;
            margin-right: 12px;
        }

        .social_meda {
            margin-top: 0px;
        }


        .history p {
            /* font-size: 13px; */
            font-size: 13px;
            font-weight: normal;
            line-height: 25px;
            letter-spacing: 0.5px;
        }

        .para_button {
            float: right !important;
            text-align: right !important;
        }

        .para_button a {
            background: #073c65;
            color: #fff;
            padding: 10px 41px;
            position: relative;
            top: 28px;

            border-radius: 5px;
            width: 100% !important;
            display: inline-block;
            text-align: center;
        }

        .para_list {
            box-shadow: none;
            border: bisque;
            width: 48% !important;
            background: #FCBDBE;
        }

        .para_button {
            margin-top: -31px;
        }

        .para_list {
            text-align: center !important;
        }

        .in__0 {
            width: 52%;
            display: inline-block;
            text-align: left;
            float: left;
            margin-top: -9px;
        }

        .about__img_08 {
            margin-top: 50px;
        }

        @media screen and (min-width:320px) and (max-width:767px) {
            .header-bottom.header_top.sticky {
                background: #fff !important;
                height: 100px;
            }

            .footer-top .container {
                width: 93% !important;
            }

            .col-md-2asfasf .search-form.d__rtt {
                width: 238px !important;
                right: 15px !important;
                margin-top: -33px;
                position: absolute;
                z-index: 9999;
            }

            .para_button {
                text-align: center !important;
                margin-top: 0px !important;
                padding-top: 0px !important;
            }

            .mb-0 {
                font-size: 14px;
                letter-spacing: 0.5px;
                color: #000;
            }

            .left__cont h3 {
                color: #000;
                text-transform: uppercase;
                font-size: 30px;
                margin-bottom: 37px;
            }

            .c__heading_0s h3 {
                color: #000;
                text-transform: uppercase;
                font-size: 19px;
                width: 100%;
                margin-left: auto;
                margin-right: auto;
                line-height: 26px;
            }

            .servil__list ul li {
                margin-left: -17px !important;
            }

            .servil__list li {
                list-style: none;
                width: 100%;
                /* display: inline-block; */
                border: 1px solid #00000026;
                height: auto;
                float: left;
                padding: 14px;
                margin: 11px;
                color: #000;
                border-radius: 7px;
                text-align: left;
                box-shadow: 0 0 5px 2px #00000017;
                font-size: 13px;
            }

            .s__0f {
                text-transform: uppercase;
                color: #000;
                text-align: center;
                font-size: 30px;
                margin-bottom: 51px;
            }

            .khe__team {
                text-align: center;
                margin-bottom: 45px;
            }

            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 1.25rem;
                font-size: 14px;
            }

            .our_team {
                padding-top: 20px;
                padding-bottom: 20px;
                float: left;
                width: 100%;
            }

            .about__banner__s .container {
                width: 100%;
            }

            .about__img_08 iframe {
                border-radius: 11px;
                box-shadow: 0 0 8px 2px #00000069;
                margin-top: 31px;
            }

            .left__cont {
                padding-top: 0px !important;
                width: 100% !important;
            }

            .sg-menu .navbar-nav li a {
                color: #222;
                display: block;
                font-weight: 400;
                padding: 9px 0px 12px 20px;
                margin-right: 20px;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .footer-top {
                padding: 0px !important;
            }

            .khe__team {
                position: relative;
                width: 200px;
                height: 200px;
                float: left;
                margin-right: 10px;
                padding-top: 11px;
                margin-left: 69px !important;
            }
        }
    </style>
    <section class="about__banner__s">



        <div class="container">


            <div class="row">
                <div class="col-md-6">
                    <div class="left__cont">
                        <h3>About Pharmashots</h3>
                        <ul class="knf">
                            <li>PharmaShots brings curated, summarized, authentic and insightful life science and
                                pharmaceutical global news for their readers</li>
                            <li>PharmaShots offers their reader critical insights and exclusive anecdotes on the
                                technologies, products, deals, funding, companies, and products influencing paradigm shifts
                                in the life science industry affecting human health</li>
                            <li>We bring you news from boardrooms, labs, sales teams, hospitals and other KOL and experts to
                                your inbox</li>
                        </ul>

                    </div>

                </div>


                <div class="col-md-6">
                    <div class="about__img_08">

                        <iframe width="560" height="350" src="https://www.youtube.com/embed/9QJ6KVsvOg8"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>


                        <!--	   <img src="{{ static_asset('site/images/about__img.png') }} "  >-->

                    </div>
                </div>

            </div>

        </div>
    </section>
    <section class="history_goals">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="goal">
                        <div class="row">
                            <div class="col-md-6"><img src="{{ static_asset('site/images/imgg.png') }} "></div>
                            <div class="col-md-6">
                                <h3>PharmaShots <br>Goal</h3>
                                <p>Our goal is to deliver unbiased information and profound insights to our readers every
                                    day. PharmaShots team is steered to serve our readers with honesty and dedication.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="history">
                        <div class="row">
                            <div class="col-md-6"><img src="{{ static_asset('site/images/imgg2.png') }} "></div>
                            <div class="col-md-6">
                                <h3>PharmaShots History</h3>
                                <p>Our journey started with a blog at first, which in no time grew larger to become a news
                                    portal, which was an exceptionally great success for us. After receiving so many
                                    positive responses.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services__009" id="about_services">
        <div class="container">
            <div class="c__heading_0s">
                <h3>What all is included in our premium Bespoke service?</h3>
                <p>Our paid subscribers will be privy to</p>
            </div>

            <div class="row">

                <div class="servil__list">


                    <ul>
                        <li><i class="fa fa-check-circle"></i><br>All the tailored, customized indication/ therapy area news
                            of their interest</li>
                        <li><i class="fa fa-check-circle"></i><br>Top 20 reports (before our general readers)</li>
                        <li><i class="fa fa-check-circle"></i><br>Insight+ articles (before public readers, TA specific)
                        </li>
                        <li><i class="fa fa-check-circle"></i><br>Viewpoints (~1 month before public publication, TA
                            specific)</li>
                        <li><i class="fa fa-check-circle"></i><br>Regulatory news updates (NIH, FDA, EMA among other, TA
                            specific)</li>
                        <li><i class="fa fa-check-circle"></i><br>Congress coverage (press release coverage, TA specific)
                        </li>
                        <li><i class="fa fa-check-circle"></i><br>KOL interviews (therapy area specific)</li>
                        <li><i class="fa fa-check-circle"></i><br>Monthly reports</li>
                        <li><i class="fa fa-check-circle"></i><br>Yearly report and trend analysis</li>
                        <li><i class="fa fa-check-circle"></i><br>Clinical trial updates</li>
                        <li class="para_list new__paralist"><span class="in__0">Connect with us to know more about
                                our premium bespoke service. </span> <span class="para_button"><a
                                    href="{{ url('/') }}/be-spoke">Contact us</a></span> </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>


    <section class="accordion__0-988" id="about_faq">

        <div class="container">

            <h3 class="s__0f">FAQ</h3>
            <!--Accordion wrapper-->
            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                <!-- Accordion card -->
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingOne1">
                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                            aria-controls="collapseOne1">
                            <h5 class="mb-0">
                                Why we call ourselves PharmaShots? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            It is the amalgamation of two words “Pharma” and “Shots”. Pharma because we are
                            pharma, life science dedicated news alerts service. PharmaShots publishes real-time
                            summarized news in <strong>three</strong> shots from global pharma, biotech, medical devices,
                            digital
                            health, diagnostics, and life sciences industry readable in 60 seconds.
                        </div>
                    </div>

                </div>
                <!-- Accordion card -->

                <!-- Accordion card -->
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingTwo2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                            aria-expanded="false" aria-controls="collapseTwo2">
                            <h5 class="mb-0">
                                Is PharmaShots part of Octavus Consulting? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            The dedicated team of Octavus Consulting independently runs PharmaShots. Our team
                            is based in India.
                        </div>
                    </div>

                </div>
                <!-- Accordion card -->

                <!-- Accordion card -->
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingThree3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                            aria-expanded="false" aria-controls="collapseThree3">
                            <h5 class="mb-0">
                                Is PharmaShots Free? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            PharmaShots is free service. We also offer PharmaShots Bespoke, a premium
                            subscription plan that includes exclusive indication/ therapy area reporting about the
                            pharmaceutical and biotech industries, the health tech industry, and coverage along
                            with summarization of regulatory policies. Learn more about it <strong><a
                                    href="{{ url('/') }}/be-spoke">here</a></strong>.
                        </div>
                    </div>

                </div>




                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingFour4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFour4"
                            aria-expanded="false" aria-controls="collapseFour4">
                            <h5 class="mb-0">
                                What all is included in our premium Bespoke service? <i
                                    class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseFour4" class="collapse" role="tabpanel" aria-labelledby="headingFour4"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Our paid subscribers will be privy to</p>
                            <ul>
                                <li>All the tailored, customized indication/ therapy area news of their interest</li>
                                <li>Clinical trial updates</li>
                                <li>Insight+ articles (before public readers, TA specific)</li>
                                <li>Viewpoints (~1 month before public publication, TA specific)</li>
                                <li>Regulatory news updates (NIH, FDA, EMA among other, TA specific)</li>
                                <li>Congress coverage (press release coverage, TA specific)</li>
                                <li>KOL interviews (therapy area specific)</li>
                                <li>Monthly reports</li>
                                <li>Yearly report and trend analysis</li>
                            </ul>
                            <p>Click <strong><a href="{{ url('/') }}/be-spoke">here</a></strong> to show interest and
                                find our pricing.</p>
                        </div>

                    </div>






                    <!-- Accordion card -->

                </div>
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingFive5">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseFive5"
                            aria-expanded="false" aria-controls="collapseFive5">
                            <h5 class="mb-0">
                                Do we offer any other services?<i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseFive5" class="collapse" role="tabpanel" aria-labelledby="headingFive5"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            Yes, we also offer PharmaShots Newswire (PS Newswire). Where we write, create and
                            distribute companies’ press release. We also offer the summarized news delivery to all
                            PharmaShots readers. Find more details <strong><a
                                    href="{{ url('/') }}/news-wire">here</a></strong>.
                        </div>
                    </div>

                </div>

                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingSix6">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSix6"
                            aria-expanded="false" aria-controls="collapseSix6">
                            <h5 class="mb-0">
                                Want to know about your writers? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseSix6" class="collapse" role="tabpanel" aria-labelledby="headingSix6"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <p>We are a team of highly experienced healthcare professionals, we are not journalist, we
                                deliver healthcare and pharma graduates who understand science and like to present
                                facts in straight in neutral language. Meet our team <strong><a
                                        href="#our_team">here</a></strong>.</p>
                        </div>
                    </div>

                </div>
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingSeven7">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseSeven7"
                            aria-expanded="false" aria-controls="collapseSeven7">
                            <h5 class="mb-0">
                                Who are our readers? <i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseSeven7" class="collapse" role="tabpanel" aria-labelledby="headingSeven7"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <ul>
                                <li>Our news service is specially designed to cater to global healthcare, pharma and life
                                    sciences professionals including. Brand manager, Marketing heads, Brand directors, CI
                                    Directors/managers.
                                </li>
                                <li>However, it is also useful for life sciences executives working in any department as our
                                    news is easy to read and understand.
                                </li>
                                <li>Our readers are not limited to professionals mentioned above as we have also readers
                                    from executive search, HR, Real estate companies providing services to life sciences
                                    companies.
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingEight8">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseEight8"
                            aria-expanded="false" aria-controls="collapseEight8">
                            <h5 class="mb-0">
                                How frequently is the site updated?<i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseEight8" class="collapse" role="tabpanel" aria-labelledby="headingEight8"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <p>We update our website on daily basis. You can subscribe to our daily newsletter <strong><a
                                        href="#">here</a></strong> .</p>
                        </div>
                    </div>

                </div>
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingNine9">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseNine9"
                            aria-expanded="false" aria-controls="collapseNine9">
                            <h5 class="mb-0">
                                How can a reader be able to keep up with PharmaShots coverage? <i
                                    class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseNine9" class="collapse" role="tabpanel" aria-labelledby="headingNine9"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <p>You can visit our site or as often as you can, if you like what we are serving you. We
                                have a plethora of information for you. You can sign up for our newsletter here. In
                                addition, you can follow us on <strong><a
                                        href="https://www.facebook.com/Pharmashots/

    ">Facebook</a></strong>, on
                                <strong><a href="https://twitter.com/Pharmashot">Twitter</a></strong> , and on <strong><a
                                        href="https://www.linkedin.com/showcase/the-pharmashots/">LinkedIn</a></strong>.
                            </p>
                        </div>
                    </div>

                </div>
                <div class="card">

                    <!-- Card header -->
                    <div class="card-header" role="tab" id="headingTen10">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTen10"
                            aria-expanded="false" aria-controls="collapseTen10">
                            <h5 class="mb-0">
                                What all is part of free PharmaShots services?<i class="fa fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div id="collapseTen10" class="collapse" role="tabpanel" aria-labelledby="headingTen10"
                        data-parent="#accordionEx">
                        <div class="card-body">
                            <p>Most of our services are free for our readers. To name few</p>
                            <ul>
                                <li>News alerts (Daily 6 news)
                                </li>
                                <li>Top 20</li>
                                <li>Insight+</li>
                                <li>Viewpoint Interviews</li>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- Accordion wrapper -->
            </div>
        </div>

    </section>
    <section class="our_team" id="our_team">
        <div class="container">
            <h3 class="s__0f">Our Team</h3>
            <div class="row dsk__top_23">

                @php
                  $aboutUsers =   \Modules\User\Entities\User::orderBy('order_about', 'ASC')->where('status_about', 'show')->where('is_active', '1')->get();
                 
                @endphp





               
                    @foreach($aboutUsers as $key=>$aboutUser)
               

                <div class="col-md-22">


                    <div class="box4">
                        <div class="sicons__09"> <img src="{{ static_asset($aboutUser->profile_image) }} ">




                        </div>

                        <div class="box-content">
                            <div class="show__services__09">


                                <p>{!!$aboutUser->about !!}</p>


                            </div>
                        </div>
                    </div>
                    <div class="khe__team">
                        <h3>{{$aboutUser->first_name}} {{$aboutUser->last_name}}</h3>                        
                        <p>{{$aboutUser->position}}</p>
                        <ul class="social_meda">


                            <li> <a href="{{$aboutUser->social_media}}"><i
                                        class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>


                </div>
                @endforeach

                {{-- <div class="col-md-22">

                    <div class="box4">
                        <div class="sicons__09"><img src="{{ static_asset('site/images/Tuba.png') }} ">




                        </div>

                        <div class="box-content">
                            <div class="show__services__09">

                                <p>Tuba Khan is Senior Editor at PharmaShots. She is curious, creative, and passionate
                                    about recent updates and innovation in the Life sciences industry. She covers
                                    Biopharma, MedTech, and Digital health segments. Tuba also has an experience of
                                    digital and social media marketing and runs the campaigns independently. She can be
                                    contacted on <a href="#">tuba@pharmashots.com</a></p>


                            </div>
                        </div>
                    </div>
                    <div class="khe__team">
                        <h3>Tuba Khan </h3>
                        <p>Senior Editor</p>
                        <ul class="social_meda">


                            <li> <a href="LinkedIn: https://www.linkedin.com/in/tuba-khan-397140133/"><i
                                        class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>

                </div> --}}




                <!-- <div class="col-md-22">



            <div class="box4">
             <div class="sicons__09"> <img src="{{ static_asset('site/images/4.png') }} ">




             </div>

             <div class="box-content">
              <div class="show__services__09">


               <p>Vartika Singh is a content writer who loves to write research articles and reports at
                PharmaShots. She has in-depth knowledge of the life sciences industry including the
                Pharma and Biotech sectors. Any articles written by her can be contacted at
                connect <a href="#">@pharmashots.com</a></p>


              </div>
             </div>
            </div>
            <div class="khe__team">
             <h3>Vartika Singh</h3>
             <p>Editor & Content Writer</p>
             <ul class="social_meda">


              <li> <a href="https://www.linkedin.com/in/vartika-singh-392020114/"><i class="fa fa-linkedin"></i></a></li>
             </ul>
            </div>
           </div> -->


                {{-- <div class="col-md-22">



                    <div class="box4">
                        <div class="sicons__09"><img src="{{ static_asset('site/images/image4newmwmbwr.png') }} ">




                        </div>

                        <div class="box-content">
                            <div class="show__services__09">


                                <p>Neha Madan is a content writer at PharmaShots. She is passionate and very
                                    enthusiastic about recent updates and developments in the life sciences and pharma
                                    industry. She covers Biopharma, MedTech, and Digital health segments along with
                                    different reports at PharmaShots.</p>


                            </div>
                        </div>
                    </div>
                    <div class="khe__team">
                        <h3>Neha Madan</h3>
                        <p>Content Writer</p>
                        <ul class="social_meda">


                            <li> <a href="https://www.linkedin.com/in/neha-madan-5059681ab/"><i
                                        class="fa fa-linkedin" ></i></a></li>
                        </ul>
                    </div>
                </div>



                <div class="col-md-22">


                    <div class="box4">
                        <div class="sicons__09"> <img src="{{ static_asset('site/images/imagenewmember.png') }} ">




                        </div>

                        <div class="box-content">
                            <div class="show__services__09">


                                <p>Akanksha Tripathi is Associate at Octavus Consulting. She is actively involved as a
                                    content writer at Pharmashots and skilled in Competitive Intelligence, Data analysis &
                                    Secondary Research. She is passionate, meticulous, diligent, and inquisitive.</p>


                            </div>
                        </div>
                    </div>
                    <div class="khe__team">
                        <h3>Akanksha Tripathi</h3>
                        <p>Content Writer</p>
                        <ul class="social_meda">


                            <li> <a href="https://www.linkedin.com/in/akanksha-tripathi-17049a1aa/"><i
                                        class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>


                </div> --}}








            </div>

        </div>
    </section>
@endsection


<style>
    /*********************** Demo - 1 *******************/
    .box1 img,
    .box1:after,
    .box1:before {
        width: 100%;
        transition: all .3s ease 0s
    }

    .box1 .icon,
    .box2,
    .box3,
    .box4,
    .box5 .icon li a {
        text-align: center
    }

    .box10:after,
    .box10:before,
    .box1:after,
    .box1:before,
    .box2 .inner-content:after,
    .box3:after,
    .box3:before,
    .box4:before,
    .box5:after,
    .box5:before,
    .box6:after,
    .box7:after,
    .box7:before {
        content: ""
    }

    .box1,
    .box11,
    .box12,
    .box13,
    .box14,
    .box16,
    .box17,
    .box18,
    .box2,
    .box20,
    .box21,
    .box3,
    .box4,
    .box5,
    .box5 .icon li a,
    .box6,
    .box7,
    .box8 {
        overflow: hidden
    }

    .box1 .title,
    .box10 .title,
    .box4 .title,
    .box7 .title {
        letter-spacing: 1px
    }

    .box3 .post,
    .box4 .post,
    .box5 .post,
    .box7 .post {
        font-style: italic
    }

    body {
        background-color: #f1f1f2
    }

    .mt-30 {
        margin-top: 30px
    }

    .mt-40 {
        margin-top: 40px
    }

    .mb-30 {
        margin-bottom: 30px
    }

    .box1 .icon,
    .box1 .title {
        margin: 0;
        position: absolute
    }

    .box1 {
        box-shadow: 0 0 3px rgba(0, 0, 0, .3);
        position: relative
    }

    .box1:after,
    .box1:before {
        height: 50%;
        background: rgba(0, 0, 0, .5);
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        transform-origin: 100% 0;
        transform: rotateZ(90deg)
    }

    .box1:after {
        top: auto;
        bottom: 0;
        transform-origin: 0 100%
    }

    .box1:hover:after,
    .box1:hover:before {
        transform: rotateZ(0)
    }

    .box1 img {
        height: auto;
        transform: scale(1) rotate(0)
    }

    .box1:hover img {
        filter: sepia(80%);
        transform: scale(1.3) rotate(10deg)
    }

    .box1 .title {
        font-size: 19px;
        font-weight: 600;
        color: #fff;
        text-transform: uppercase;
        text-shadow: 0 0 1px #004cbf;
        bottom: 10px;
        left: 10px;
        opacity: 0;
        z-index: 2;
        transform: scale(0);
        transition: all .5s ease .2s
    }

    .box1:hover .title {
        opacity: 1;
        transform: scale(1)
    }

    .box1 .icon {
        padding: 7px 5px;
        list-style: none;
        background: #004cbf;
        border-radius: 0 0 0 10px;
        top: -100%;
        right: 0;
        z-index: 2;
        transition: all .3s ease .2s
    }

    .box1:hover .icon {
        top: 0
    }

    .box1 .icon li {
        display: block;
        margin: 10px 0
    }

    .box1 .icon li a {
        display: block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        border-radius: 10px;
        font-size: 18px;
        color: #fff;
        transition: all .3s ease 0s
    }

    .box2 .icon li a,
    .box3 .icon a:hover,
    .box4 .icon li a:hover,
    .box5 .icon li a,
    .box6 .icon li a {
        border-radius: 50%
    }

    .box1 .icon li a:hover {
        color: #fff;
        box-shadow: 0 0 10px #000 inset, 0 0 0 3px #fff
    }

    @media only screen and (max-width:990px) {
        .box1 {
            margin-bottom: 30px
        }
    }

    /*********************** Demo - 2 *******************/


    /*********************** Demo - 4 *******************/
    .box4 {
        position: relative
    }

    .box4:before {
        width: 0;
        height: 200%;
        background: rgba(0, 0, 0, .5);
        position: absolute;
        top: 0;
        left: -250px;
        bottom: 0;
        transform: skewX(-36deg);
        transition: all .5s ease 0s
    }

    .box4:hover:before {
        width: 200%
    }

    .box4 img {
        width: 100%;
        height: auto
    }

    .box4 .box-content {
        width: 100%;
        height: 100%;
        padding-top: 20%;
        position: absolute;
        top: 0;
        left: 0;
        transform: scale(0);
        transition: all .3s ease 0s
    }

    .box4 .icon,
    .box5 .icon {
        list-style: none;
        padding: 0
    }

    .box4:hover .box-content {
        transform: scale(1)
    }

    .box4 .title {
        font-size: 22px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 10px
    }

    .box4 .post {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 20px
    }

    .box4 .icon {
        margin: 0
    }

    .box4 .icon li {
        display: inline-block
    }

    .box4 .icon li a {
        display: block;
        width: 35px;
        height: 35px;
        line-height: 35px;
        font-size: 20px;
        background: #fff;
        color: #ee4266;
        margin-right: 10px;
        transition: all .3s ease 0s
    }

    .box5 .icon,
    .box5 .icon li {
        display: inline-block
    }

    @media only screen and (max-width:990px) {
        .box4 {
            margin-bottom: 30px
        }
    }

    @media only screen and (max-width:767px) {
        .box4:before {
            left: -400px
        }

        .box4:hover:before {
            width: 300%
        }
    }

    .box4 img {
        width: 65%;
        height: auto;
        padding-top: 0px;
    }

    .box4::before {
        width: 0;
        height: 200%;
        background: #073c65 !important;
        position: absolute;
        top: 0;
        left: -250px;
        bottom: 0;
        transform: skewX(-36deg);
        transition: all .5s ease 0s;
    }

    .box-content .show__services__09 h3 {
        color: #fff;
        font-weight: 600;
        margin-top: 0px;
        font-size: 21px;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .show__services__09 {
        text-align: center;
        border: 1px solid #ffffff7a;
        padding: 11px;
        border-radius: 3px;
        margin-bottom: 32px;
        height: 226px;
        margin-top: -40px !important;
    }

    .box-content .show__services__09 p {
        color: #fff;
        font-weight: 400;
        font-size: 10px;
        line-height: 19px;
        margin-top: -2px;
    }

    .box-content .readmore__0 {
        color: #fff;
        margin-top: 42px;
        display: inline-block;
        border: 1px solid #ffffff57;
        padding: 5px 15px 5px 13px;
        border-radius: 39px;
    }

    .sicons__09 h3 {
        color: #344a5f;
        font-weight: 600;
        font-size: 24px;
        margin-top: 31px;
    }

    .services_slide {
        padding: 12px;
    }

    .process__count {
        margin-top: -289px;
        /* top: 34px; */
    }


    .process__counttts__89 {
        position: relative;
        top: 53px;
    }

    .events__section {
        padding-top: 52px;
    }

    .user__pic img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 0 6px 2px #00000045;
        margin-top: 19px;
        margin-left: auto;
        margin-right: auto;
    }

    .slide_s {
        text-align: center;
        padding: 63px;
    }

    .testimonial__news {
        background: #fff;
    }

    .user__contents h3 {
        font-weight: 500;
        font-size: 18px;
        padding-top: 16px;
        margin-bottom: 6px;
    }

    .user__contents p {
        font-size: 14px;
        line-height: 20px;
    }

    .testimonial__news {
        padding-bottom: 0px;
    }

    .boder__font h3 {
        border-left: none;
        padding-left: 17px;
        margin-top: 39px;
        margin-bottom: 40px;
    }

    .khe__team h3 {
        font-size: 18px;
        color: #000;
    }

    .boder__font {
        text-align: center;
    }

    .sicons__09 img {
        height: 200px;
        width: 200px;
        border-radius: 50%;
        box-shadow: 2px 0 11px 3px #0000003b;
    }

    .sicons__09 {
        margin-top: 14px;
        height: 231px;
    }

    .show__services__09:hover a {
        color: #fff;
        text-decoration: underline;
    }

    .para_list {
        background: none;
        box-shadow: none !important;
        border: none !important;
    }

    .para_button {
        background: none;
        box-shadow: none !important;
        border: none !important;
    }

    .para_list {
        font-size: 15px !important;
        line-height: 23px;
        padding-top: 33px !important;
    }

    .para_button a {
        background: #073c65;
        color: #fff;
        padding: 10px 41px;
        position: relative;
        top: 28px;


        border-radius: 5px;
    }

    .para_button a:hover {
        color: #fff;


        border-radius: 5px;
    }
</style>
