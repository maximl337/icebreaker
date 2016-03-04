@extends('templates.main')

@section('head')
    
    <style type="text/css">
        body {
            font-weight: 300;
        }
    </style>
@stop

@section('content')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			
			<section>
				
				<form id="icebreaker" role="form">
					
					<fieldset>
						<legend>Enter some basic information of the person to search</legend>

						<div class="form-group">
							<label for="full_name">Full Name</label>
							<input id="full_name" class="form-control " type="text" name="full_name" value="test" placeholder="Bob Fett" required />
						</div>	

						<div class="form-group">
							<label for="">Email</label>
							<input id="" class="form-control" type="email" name="email" value="jay@jaymoonah.com" placeholder="bob@example.com" required />
						</div>

						<div class="form-group">
							<input type="submit" value="Search" class="form-control btn btn-primary" />	
						</div>

					</fieldset>
					
				</form>

			</section>

			<section>

				<div class="fullcontact" style="display: none;">
				
				<h3>FullContact Data</h3>
				<pre></pre>

				</div>

				<div class="twitter" style="display: none;">
				<h3>Twitter Data</h3>
				<pre></pre>
				</div>

                <div class="linkedin" style="display: none;">
                <h3>Linkedin Data</h3>
                <pre></pre>
                </div>


				
			</section>
			
			

		</div> <!-- /.col -->
	</div> <!-- /.row -->

@stop

@section('footer')

<script type="text/javascript">

    $("form#icebreaker").on("submit", function(e) {
        e.preventDefault()

        swal({
            title: "Loading",   
            text: "Searching the internet for information...",   
            imageUrl: loadingGif,  
            showConfirmButton: false
        });

        var input = $(this).serialize();

        $.ajax({
            url: 'fullcontact',
            method: 'POST',
            data: input,
            dataType: 'json',
            success: function(data) {

            	console.log(data);

            	var data = data[0];

                var fullcontactData = data.fullcontact.obj;

                $(".fullcontact").show();

                $(".fullcontact pre").text(JSON.stringify(fullcontactData, null, '\t'));

                
                if(data.hasOwnProperty("twitter")) {
                	
                	$(".twitter").show();

                	$(".twitter pre").text(JSON.stringify(data.twitter.obj[0], null, '\t'));
                }

                if(data.hasOwnProperty("linkedin")) {

                    $(".linkedin").show();

                    $(".linkedin pre").text(JSON.stringify(data.linkedin, null, '\t'));
                }

                swal.close();
                //swal("Did not find any records!", "Connection to API was succesful, but no users were returned.", "error");

            },
            error: function (request, status, error) {

                console.error(JSON.parse(request.responseText));

                swal("Error!", request.responseText, "error");
                
            }
        });

    });


    // function showLikelihood (likelihood) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-4">';
    //     content += '<div class="alert alert-warning"><h4>Likelihood: ' + likelihood + '</h4></div></div></div>';
    //     $(".results").append(content);
    // }

    // function showContactInfo (contactInfo) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-12">';
    //     content += '<div class="alert alert-info"><strong>Contact Info </strong></div>';
    //     content += contactInfo.familyName ? '<p>Family Name: ' + contactInfo.familyName + '</p>' : '';
    //     content += contactInfo.givenName ? '<p>Given Name: ' + contactInfo.givenName + '</p>' : '';

    //     if(contactInfo.websites) {
    //         $.each(contactInfo.websites, function(index, value) {
                
    //             content += '<p>Website #' + index + ': ' + value.url + '</p>';
    //         });
    //     }

    //     content += '</div></div>';

    //     $(".results").append(content);
    // }

    // function showPhotos (photos) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-12">';
    //     content += '<div class="alert alert-warning"><strong>Photos </strong></div>';
    //     content += '<div class="row">';
    //     $.each(photos, function(i, v) {
    //         content += '<div class="col-md-4">';
    //         content += '<img src="' + v.url + '" />';
    //         content += v.typeName ? '<p><em>' + v.typeName + '</em></p>' : '';
    //         content += '</div>';
    //     });
    //     content += '</div></div></div>';

    //     $(".results").append(content);
    // }

    // function showOrganizations (organizations) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-12">';
    //     content += '<div class="alert alert-info"><strong>Organizations </strong></div>';
    //     content += '<div class="row">';
    //     $.each(organizations, function(i, v) {
    //         content += '<div class="col-md-4">';
    //         content += v.name ? '<h2>' + v.name + '</h2>' : '';
    //         content += v.title ? '<p><em>' + v.title + '</em></p>' : '';
    //         content += v.startDate ? '<p><small>' + v.startDate + '</small></p>' : '';
    //         content += '</div>';
    //     });
    //     content += '</div></div></div>';

    //     $(".results").append(content);
    // }

    // function showSocialProfiles (socialProfiles) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-12">';
    //     content += '<div class="alert alert-success"><strong>Social Profiles </strong></div>';
    //     content += '<div class="row">';
    //     $.each(socialProfiles, function(i, v) {
    //         content += '<div class="col-md-4">';
    //         content += v.typeName ? '<h2>' + v.typeName + '</h2>' : '';
    //         content += v.url ? '<p><a href="'+v.url+'">' + v.url + '</a></p>' : '';
    //         content += v.username ? '<p>' + v.username + '</p>' : '';
    //         content += '</div>';
    //     });
    //     content += '</div></div></div>';

    //     $(".results").append(content);
    // }

    // function showDemographics (demographics) {
    //     var content = '<div class="row">';
    //     content += '<div class="col-md-12">';
    //     content += '<div class="alert alert-info"><strong>Demographics </strong></div>';
    //     content += demographics.locationDeduced.normalizedLocation ? '<p>Location: ' + demographics.locationDeduced.normalizedLocation + '</p>' : '';
    //     content += demographics.age ? '<p>Age: ' + demographics.age + '</p>' : '';
    //     content += demographics.gender ? '<p>Gender: ' + demographics.gender + '</p>' : '';
    //     content += '</div></div>';

    //     $(".results").append(content);
    // }


// {
//   "status": {"type":"number"},
//   "requestId": {"type":"string"},
//   "likelihood": {"type":"number"},
//   "contactInfo": {
//     "familyName": {"type":"string"},
//     "givenName": {"type":"string"},
//     "fullName": {"type":"string"},
//     "middleNames": 
//     [
//       {"type":"string"}
//     ],
//     "websites": 
//     [
//       {
//         "url": {"type":"string"}
//       }
//     ],
//     "chats": 
//     [
//       {
//         "handle": {"type":"string"},
//         "client": {"type":"string"}
//       }
//     ]
//   },
//   "demographics": {
//     "locationGeneral": {"type":"string"},
//     "locationDeduced": {
//       "normalizedLocation": {"type":"string"},
//       "deducedLocation" : {"type":"string"},
//       "city" : {
//         "deduced" : {"type":"boolean"},
//         "name" : {"type":"string"}
//       },
//       "state" : {
//         "deduced" : {"type":"boolean"},
//         "name" : {"type":"string"},
//         "code" : {"type":"string"}
//       },
//       "country" : {
//         "deduced" : {"type":"boolean"},
//         "name" : {"type":"string"},
//         "code" : {"type":"string"}
//       },
//       "continent" : {
//         "deduced" : {"type":"boolean"},
//         "name" : {"type":"string"}
//       },
//       "county" : {
//         "deduced" : {"type":"boolean"},
//         "name" : {"type":"string"},
//         "code" : {"type":"string"}
//       },
//       "likelihood" : {"type":"number"}
//     },
//     "age": {"type":"string"},
//     "gender": {"type":"string"},
//     "ageRange": {"type":"string"}
//   },
//   "photos": 
//   [
//     {
//       "typeId": {"type":"string"},
//       "typeName": {"type":"string"},
//       "url": {"type":"string"},
//       "isPrimary": {"type":"boolean"}
//     }
//   ],
//   "socialProfiles": 
//   [
//     {
//       "typeId": {"type":"string"},
//       "typeName": {"type":"string"},
//       "id": {"type":"string"},
//       "username": {"type":"string"},
//       "url": {"type":"string"},
//       "bio": {"type":"string"},
//       "rss": {"type":"string"},
//       "following": {"type":"number"},
//       "followers": {"type":"number"}
//     }
//   ],
//   "digitalFootprint": {
//     "topics": 
//     [
//       {
//         "value": {"type":"string"},
//         "provider": {"type":"string"}
//       }
//     ],
//     "scores": 
//     [
//       {
//         "provider": {"type":"string"},
//         "type": {"type":"string"},
//         "value": {"type":"number"}
//       }
//     ]
//   },
//   "organizations": 
//   [
//     {
//       "title": {"type":"string"},
//       "name": {"type":"string"},
//       "startDate": {"type":"string"},   // formatted as "YYYY-MM"
//       "endDate":  {"type":"string"},    // formatted as "YYYY-MM"
//       "isPrimary": {"type":"boolean"}
//       "current": {"type":"boolean"}
//     }
//   ]
// }
    </script>

@endsection