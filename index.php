
<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>
   
</head>
<body>
<script>

<script>
window.ORIGINAL_JSON=window.JSON;
</script>

<!-- content wrapper --><div class=main><div class="center clear"><!-- main content column --><main id=main><!--CONTENT-->
<div class="demo-wrapper">

<h1>Demo:  Camera and Video Control with HTML5</h1>

<div class="demo-conversion">Read <a href="https://davidwalsh.name/browser-camera" target="_top">Camera and Video Control with HTML5</a></div>

<div id="promoNode"></div>

	<p>Using Opera Next or Chrome Canary, use this page to take your picture!</p>

	<!--
		Ideally these elements aren't created until it's confirmed that the
		client supports video/camera, but for the sake of illustrating the
		elements involved, they are created with markup (not JavaScript)
	-->
	<video id="video" width="640" height="480" autoplay></video>
	<button id="snap" class="sexyButton">Snap Photo</button>
	<canvas id="canvas" width="640" height="480"></canvas>

    <form method="post" accept-charset="utf-8" name="form1">
        <input name="hidden_data" id='hidden_data' type="hidden"/>
    </form>

	<script>

		// Put event listeners into place
		window.addEventListener("DOMContentLoaded", function() {
			// Grab elements, create settings, etc.
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');
            var mediaConfig =  { video: true };
            var errBack = function(e) {
            	console.log('An error has occurred!', e)
            };

			// Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }

            /* Legacy code below! */
            else if(navigator.getUserMedia) { // Standard
				navigator.getUserMedia(mediaConfig, function(stream) {
					video.src = stream;
					video.play();
				}, errBack);
			} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
				navigator.webkitGetUserMedia(mediaConfig, function(stream){
					video.src = window.webkitURL.createObjectURL(stream);
					video.play();
				}, errBack);
			} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
				navigator.mozGetUserMedia(mediaConfig, function(stream){
					video.src = window.URL.createObjectURL(stream);
					video.play();
				}, errBack);
			}

			// Trigger photo take
			document.getElementById('snap').addEventListener('click', function() {
				context.drawImage(video, 0, 0, 280, 280);
                uploadEx();
			});


            function uploadEx() {
                var canvas = document.getElementById("canvas");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);

                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
                    }
                };

                xhr.onload = function() {

                };
                xhr.send(fd);
            };




		}, false);





	</script>

    <script>

    </script>

</body>
</html>
