@extends('RetailShop::layouts.app')
@section('content')
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"-->
<!--    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
<style>
    .delete_image {
        position: absolute;
        background: #f7f7f7;
        padding: 3px 5px;
        top: -33px;
        border-radius: 50px;
        right: 3px;
    }

    .p_relative {
        position: relative;
    }

    .delete_image1 {
        position: absolute;
        background: #f7f7f7;
        padding: 3px 5px;
        top: -79px;
        border-radius: 50px;
        right: 55px;
    }

    div.container {
        width: 100%;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100% !important;
        border: 1px solid #ddd;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        width: auto;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .form_footer_ {
        position: fixed;
        bottom: 0px;
        right: 0px;
        width: 100%;
        z-index: 9999999 !important;
        background: #ff000000;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #343a40;
    }

    .nav-pills .nav-link {
        border-radius: 0.25rem;
        color: #343a40;
        border: 1px solid #343a40;
    }



    /*------ Short Description Icon Section CSS bottom-------*/

    .rk_icon_container_btm input:checked+label {
        background: #4c9f64;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
    }

    .rk_icon_container_btm label {
        display: inline-flex;
        padding: 0 !important;
        font-weight: 600;
        text-align: center;
        border-bottom: 1px solid transparent;
        transition: all .3s ease-out 0.1s;
        color: #fff;
        margin-bottom: 0px !important;
        width: 12.5%;
        justify-content: space-evenly;
        border-top-left-radius: 25px;
        border-top-right-radius: 25px;
    }

    .rk_icon_content_btm {
        background: #4c9f64;
        color: #ffffff;
        backface-visibility: hidden;
        overflow: hidden;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        position: relative;
        top: -6px;
    }

    .rk_icon_container_btm #btm_icon-1:checked~.rk_icon_content_btm #rk_icon_content-1_btm,
    .rk_icon_container_btm #btm_icon-2:checked~.rk_icon_content_btm #rk_icon_content-2_btm,
    .rk_icon_container_btm #btm_icon-3:checked~.rk_icon_content_btm #rk_icon_content-3_btm,
    .rk_icon_container_btm #btm_icon-4:checked~.rk_icon_content_btm #rk_icon_content-4_btm,
    .rk_icon_container_btm #btm_icon-5:checked~.rk_icon_content_btm #rk_icon_content-5_btm,
    .rk_icon_container_btm #btm_icon-6:checked~.rk_icon_content_btm #rk_icon_content-6_btm,
    .rk_icon_container_btm #btm_icon-7:checked~.rk_icon_content_btm #rk_icon_content-7_btm,
    .rk_icon_container_btm #btm_icon-8:checked~.rk_icon_content_btm #rk_icon_content-8_btm {
        display: block;
        animation-name: inUp;
        animation-timing-function: ease-in-out;
        animation-duration: .6s;
    }

    .rk_icon_content_btm>div {
        display: none;
    }

    .rk_icon_container_btm label img {
        width: 100%;
    }

    #rk_icon_txt_btm {
        padding: 10px;
        font-size: 16px;
    }

    .rk_icon_container_btm input {
        display: none;
    }

    .rk_icon_content_btm p {
        display: none;
    }

    .rk_icon_container_btm p {
        margin: 0 !important;
    }

    /*------ Short Description Icon Section CSS bottom-------*/
</style>

<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <h1 class="pb-2" style="font-size:22px">
                    <h1 class="pb-2" style="font-size:22px">
                        <?= str_replace('%26', '&', $product['name']) ?>
                    </h1>

                </h1>
                <nav aria-label="breadcrumb" style="bs-breadcrumb-divider: '>'">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}" style="color:black">{{
                                __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/products') }}" style="color:black">{{
                                __('Products') }}</a></li>
                        <li class="breadcrumb-item">

                        </li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                @include('admin.products.elements.product_information')
            </div>


            @include('includes.product.product_image_gallery')
            
        </div>
    </div>
</main>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script> -->


@endsection