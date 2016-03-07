@extends('templates.main')

@section('head')

<style type="text/css">

    .title {
        font-size: 50px;
        margin-bottom: 20px;
    }
    .subtitle {
        font-size: 24px;
        margin-bottom: 20px;
        font-weight: 300;
    }
    .social-buttons {
        font-size: 18px;
    }

    .facebook, .twitter, .google, .linkedin, .foursquare, .vimeo, .flickr, .pinterest, .instagram, .tumblr {
            width:100%; margin: 10px;font-size: 20px; border-radius: 0px; font-weight: 300;
                font-family: 'Lato'; padding: 15px;}
.modal-icons{margin-left: -10px; margin-right: 20px;}
.google, .google:hover{background-color:#dd4b39;border:2px solid #dd4b39;color:#fff;}
.twitter, .twitter:hover{ background-color: #00aced; border:2px solid #00aced;color: #fff;}
.facebook, .facebook:hover{background-color: #3b5999; border:2px solid #3b5999;color:#fff;}
.linkedin, .linkedin:hover{background-color: #007bb6; border: 2px solid #007bb6; color:#fff;}
.vimeo, .vimeo:hover{ background-color: #aad450; border: 2px solid #aad450; color:#fff; }
.flickr, .flickr:hover{ background-color: #ff0084; border: 2px solid #ff0084; color:#fff; }
.foursquare, .foursquare:hover{ background-color: #0072b1; border: 2px solid #0072b1; color:#fff;}
.pinterest, .pinterest:hover{  background-color: #cb2027; border: 2px solid #cb2027; color:#fff; }
.instagram, .instagram:hover{ background-color: #517fa4; border: 2px solid #517fa4; color:#fff; } 
.tumblr, .tumblr:hover { background-color: #32506d; border: 2px solid #32506d; color:#fff; }

.connected {

    background: green;
}

.continue {

   

   

}

.continue a {
     font-size: 24px;
    display: block;
    padding: 15px;
    color: white;
    font-weight: 300;
    text-decoration: none;
    background: #87e0fd; /* Old browsers */
    background: -moz-linear-gradient(left,  #87e0fd 0%, #53cbf1 44%, #0689db 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(left,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to right,  #87e0fd 0%,#53cbf1 44%,#0689db 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#87e0fd', endColorstr='#0689db',GradientType=1 ); /* IE6-9 */
    width: 50%;
    margin: auto;
    margin-top: 20px;
}
    
</style>
@stop

@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            
            <div class="content">
                <div class="title text-center">
                    Authorize
                </div>

                <div class="subtitle text-center">
                    
                    The more social networks you connect, the more useful information we can collect on your behalf
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <div class="social-buttons">

                    @if(!is_null($user->twitter))

                        <a href='/auth/twitter' class="btn btn-default twitter disabled connected"> <i class="fa fa-twitter modal-icons"></i> Connected to Twitter </a>

                    @else
                        
                        <a href='/auth/twitter' class="btn btn-default twitter"> <i class="fa fa-twitter modal-icons"></i> Connect Twitter </a>
                        

                    @endif

                    @if(!is_null($user->facebook))

                        <a href='#/auth/facebook' class="btn btn-default facebook  disabled connected"> <i class="fa fa-facebook modal-icons"></i> Connected Facebook </a>

                    @else

                        <a href='/auth/facebook' class="btn btn-default facebook"> <i class="fa fa-facebook modal-icons"></i> Connect Facebook </a>

                    @endif

                    @if(!is_null($user->google))

                        <a href='#/auth/google' class="btn btn-default google connected disabled"> <i class="fa fa-google-plus modal-icons"></i> Connected to Google </a>

                    @else

                        <a href='/auth/google' class="btn btn-default google"> <i class="fa fa-google-plus modal-icons"></i> Connect Google </a>

                    @endif

                    @if(!is_null($user->linkedin))

                        <a href='/auth/linkedin' class="btn btn-default linkedin disabled connected"> <i class="fa fa-linkedin modal-icons"></i> Connected to Linkedin </a>

                    @else

                        <a href='/auth/linkedin' class="btn btn-default linkedin"> <i class="fa fa-linkedin modal-icons"></i> Connect Linkedin </a>

                    @endif
                           
                            
                    </div>

                    <div class="continue text-center">
                        <a href="/demo">Continue</a>
                    </div>
                    
                </div> <!-- .col -->
            </div> <!-- .row -->

		</div> <!-- /.col -->
	</div> <!-- /.row -->

@stop

@section('footer')

<script type="text/javascript">

</script>

@endsection