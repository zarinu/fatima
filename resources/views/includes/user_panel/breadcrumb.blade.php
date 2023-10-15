<div class="container my-3"><!-- start breadcrumb -->

    <ul class="breadcrumb shadow-sm bg-light p-2">

        @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item"><a href="{{!empty($breadcrumb['link']) ? $breadcrumb['link'] : '#'}}" class="font-12 vazir-font text-secondary">{{$breadcrumb['title']}}</a></li>
        @endforeach

    </ul>

</div><!-- end breadcrumb -->