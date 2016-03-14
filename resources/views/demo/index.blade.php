@extends('templates.main')

@section('head')
    
    <style type="text/css">
        body {
            font-weight: 300;
        }
        .display-none {
            display: none;
        }

        .about h3 strong {
            font-weight: 300;
            line-height: 30px;
        }

        .info h3.header {
            font-weight: 300;
        }
        .info > div {
            margin-bottom: 25px;
        }
        .info .organizations p {
            font-weight: 300;
            font-size: 20px;
            line-height: 25px;
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

            <section class="info">

                <div class="avatar display-none"></div>
                
                <div class="name display-none"></div>

                <div class="about display-none"></div>

                <div class="location display-none"></div>

                <div class="organizations display-none">
                    <h3 class="header"><em>Current positions</em></h3>
                    <hr />
                </div>

                <div class="positions display-none">
                    <h3 class="header"><em>Previous held positions</em></h3>
                    <hr />
                </div>
    
                <div class="education display-none"></div>

                <div class="social-profiles display-none">
                    <h3 class="header"><em>Social profiles</em></h3>
                    <hr />
                </div>

                <div class="links display-none"></div>


            </section>

			<section style="display: none;">

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

                <div class="googleplus" style="display: none;">
                <h3>Google+ Data</h3>
                <pre></pre>
                </div>

                <div class="websites" style="display: none;">
                <h3>Websites Data</h3>
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

            	//console.log(data);

                var name = false, 
                    avatar = false,
                    organizations = [],
                    location = false,
                    about = false,
                    oldPositions = [],
                    socialProfiles = [];

            	var data = data[0];

                var fullcontactData = data.fullcontact.obj;

                name = fullcontactData.contactInfo.fullName;

                if(fullcontactData.hasOwnProperty("photos")) {
                    avatar = fullcontactData.photos[0].url;
                }

                if(fullcontactData.hasOwnProperty("organizations")) {
                    $.each(fullcontactData.organizations, function(i, v) {
                        if(v.isPrimary == true) {
                            var r = {
                                "name": v.name,
                                "title": v.title,
                                "industry": "",
                                "summary": ""
                            };

                        } else if(v.isPrimary == false && v.current == false) {

                            var d = {
                                "name": v.name + "( " + v.startDate + " - " + v.endDate + " )",
                                "title": v.title
                            }
                        }

                        organizations.push(r);

                        oldPositions.push(d);
                    });
                }

                if(fullcontactData.hasOwnProperty("demographics")) {
                    location = fullcontactData.demographics.locationGeneral;
                }

                if(fullcontactData.hasOwnProperty("socialProfiles")) {
                    $.each(fullcontactData.socialProfiles, function(i, v) {
                        if(v.hasOwnProperty("bio")) {
                            about = v.bio;
                        }

                        var r = {
                            "name": v.type,
                            "url": v.url
                        };

                        socialProfiles.push(r);
                    });
                }

                $(".fullcontact").show();

                $(".fullcontact pre").text(JSON.stringify(fullcontactData, null, '\t'));

                // TWITTER
                if(data.hasOwnProperty("twitter")) {

                    name = name ? name : data.twitter.obj[0].name;
                    
                    avatar = avatar ? avatar : data.twitter.obj[0].profile_image_url;

                    location = location ? location : data.twitter.obj[0].location;

                	$(".twitter").show();

                	$(".twitter pre").text(JSON.stringify(data.twitter.obj[0], null, '\t'));
                }

                // LINKEDIN
                if(data.hasOwnProperty("linkedin")) {

                    name = data.linkedin.firstName + " " + data.linkedin.lastName;

                    avatar = data.linkedin.pictureUrl;

                    if(data.linkedin.hasOwnProperty("positions")) {

                        console.log('has positions');
                        if(data.linkedin.positions._total > 0) {

                            console.log('has positions');
                            organizations = [];

                            $.each(data.linkedin.positions.values, function(i,v) {
                                if(v.isCurrent) {
                                    var r = {
                                        "name": v.company.name,
                                        "title": v.title,
                                        "industry": v.company.industry,
                                        "about": v.summary
                                    }
                                }

                                organizations.push(r);
                            });
                        }
                    } // organizations

                    if(!about) {
                        about = data.linkedin.summary
                    } else {
                        about += " <br /> " + data.linkedin.summary;
                    }

                    $(".linkedin").show();

                    $(".linkedin pre").text(JSON.stringify(data.linkedin, null, '\t'));
                }

                // GOOGLE
                if(data.hasOwnProperty("google")) {

                    name = name ? name : data.google.name.givenName + data.google.name.familyName;         

                    avatar = avatar ? avatar : data.google.image.url;           

                    $(".googleplus").show();

                    $(".googleplus pre").text(JSON.stringify(data.google, null, '\t'));

                }

                // WEBSITES
                if(data.hasOwnProperty("websites")) {

                    $(".websites").show();

                    $(".websites pre").text(JSON.stringify(data.websites, null, '\t'));

                }

                if(name) showName(name);

                if(organizations.length > 0) showOrganizations(organizations);

                if(avatar) showAvatar(avatar);

                if(about) showAbout(about);

                if(oldPositions.length > 0) showOldPositions(oldPositions);

                if(socialProfiles.length > 0) showSocialProfiles(socialProfiles);

                swal.close();
                //swal("Did not find any records!", "Connection to API was succesful, but no users were returned.", "error");

            },
            error: function (request, status, error) {

                console.error(JSON.parse(request.responseText));

                swal("Error!", request.responseText, "error");
                
            }
        });

    });

    function showName (name) {
        $(".name").show().html('<h2>' + name + '</h2>');
    }

    function showAvatar (avatar) {
        $(".avatar").show().html('<img src="' + avatar + '" />');
    }

    function showOrganizations (organizations) {

        $(".organizations").show();
       
        $.each(organizations, function(i, v) {
            var i = '<div class="company">'
            i += '<h2>' + v.name + '<h2>';
            i += '<h3><em>' + v.title + '</em><h3>';
            i += '<h4>Industry: ' + v.industry + '<h4>';
            i += '<p>' + v.about + '</p>';
            i += '<div><hr />';

            $(".organizations").append(i);
        });

    }

    function showAbout (about) {
        $(".about").show().html('<h3><strong>' + about + '</strong></h3>');
    }

    function oldPositions (oldPositions) {

        $(".oldPositions").show();

        $.each(oldPositions, function(i, v) {

            if(v == undefined) return true;

            var i = '<div class="company">';
            i += '<h2>' + v.name + '<h2>';
            i += '<h3><em>' + v.title + '</em><h3>';
            i += '<div>';

            $(".oldPositions").append(i);
        });

    }

    function showSocialProfiles (socialProfiles) {

        $(".social-profiles").show();

        $.each(socialProfiles, function(i, v) {
           var i = '<div class="socialProfile"';
           i += '<h4>' + v.name + ':';
           i += '<a href="' + v.url + '">' + v.url + '</a></h4>'
           i += '</div>';

            $(".social-profiles").append(i);
        });

    }

    function showOldPositions (oldPositions) {
        
        $(".positions").show();

        $.each(oldPositions, function(i, v) {
            if(v == undefined) return true;
            var i = '<div class="oldPosition">';
            i += '<p><h4>' + v.name + '<h4>';
            if(v.title != undefined) {
                i += '<em>' + v.title + '</em></p>';    
            }
            
            i += '</div>';

            $(".positions").append(i);
        });

    }

    function showLocation (location) {
        $(".location").show().html('<h3>' + location + '</h3>');
    }

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