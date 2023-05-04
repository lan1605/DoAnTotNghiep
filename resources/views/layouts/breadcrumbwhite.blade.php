<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3 text-white">{{ ($titlePage)}}</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item text-white"><a href="<?php
              if (!isset($linkPage))
              {
                echo "/dashboard";
              }
              else {
                echo $linkPage;
              }
              ?>"><i class="bx bx-home-alt text-white"></i></a>
            </li>
            <li class="breadcrumb-item active text-white" aria-current="page">{{$breadcrumb}}</li>
        </ol>
        </nav>
    </div>
    </div>