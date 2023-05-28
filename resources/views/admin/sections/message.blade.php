@if(Session('message'))
    <div class="alert alert-{{Session('message')['type']}}" id="showMessage">
            {{ Session('message')['body'] }}
    </div>
@endif

