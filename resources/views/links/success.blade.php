<h1> Bravo </h1>

    <p>
       <a class="btn btn-primary" href=" {{ route('shortened', ['id' => $link->id]) }} ">
           {{ $link->url }}
       </a>
    </p>

