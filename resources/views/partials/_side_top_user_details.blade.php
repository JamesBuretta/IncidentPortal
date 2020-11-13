<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{Auth::user()->profile == '-' ? 'images/user.png' : 'images/profiles/'.Auth::user()->profile}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name }}</a>
    </div>
</div>
