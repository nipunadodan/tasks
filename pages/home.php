<div class="container">
    <div class="row min-vh-100 justify-content-center align-content-center text-center">
        <div class="col-8">
            <h1 class="text-thin text-loose">Orange</h1>
            <hr>
            <h2 class="h6 text-muted text-thin">Lightweight PHP Framework</h2>

            <ul class="text-left bg-light py-4 mt-4" style='line-height: 1; border-left: 6px solid var(--gray); font-family: var(--font-family-monospace'>
                <h4>What's New?</h4>
                <li>Removed all the unwanted dependencies</li>
                <li>JQuery+Bootstrap will be inside of the main includes</li>
            </ul>

            <div class="text-left my-5 bg-light p-4" id="weather">
                <h4 class="nav-title">API Sample Response</h4>
                <div class="api-response"></div>
            </div>
        </div>
    </div>
</div>
<script>
    ajaxDirect('weather',{
        q:'Colombo,LK',
        appid:"439d4b804bc8187953eb36d2a8c26a02"
    },'No','get');
</script>
