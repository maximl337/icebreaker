@extends('templates.main')

@section('head')

<style type="text/css">
    
    .title {
        font-size: 50px;
        margin-bottom: 20px;
    }

    .social-buttons {
        font-size: 18px;
        
        margin-bottom: 20px;
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
</style>
@stop

@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            
            <div class="content">
                <div class="title text-center" style="">
                    Authenticate
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                     <div class="social-buttons">
                            <a href='#/auth/facebook' class="btn btn-default facebook  disabled"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a>
                            <a href='#/auth/google' class="btn btn-default google disabled"> <i class="fa fa-google-plus modal-icons"></i> Sign In with Google </a>
                            <a href='/auth/linkedin' class="btn btn-default linkedin"> <i class="fa fa-linkedin modal-icons"></i> Sign In with Linkedin </a>
                    </div>
                    
                </div>
            </div>

		</div> <!-- /.col -->
	</div> <!-- /.row -->

@stop

@section('footer')

<script type="text/javascript">

    </script>

@endsection