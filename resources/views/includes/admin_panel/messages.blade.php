@if (session('status'))
    <div class="card-body">
        <div class="alert alert-{{session('status')}} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5>پیام</h5>
            {{session('message')}}
        </div>
    </div>
@endif