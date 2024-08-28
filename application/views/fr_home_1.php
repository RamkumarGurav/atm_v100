
    <script src="http://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        #video, #canvas {
            width: 400px;
            height: 300px;
            border-radius: 5px;
        }
        #canvas {
            position: absolute;
        }
        #status {
            margin-top: 10px;
            font-weight: bold;
        }
        #debug {
            margin-top: 20px;
            text-align: left;
            font-size: 12px;
            max-height: 100px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
    <div class="container">
        <h1>Employee Face Detection</h1>
        <div style="position: relative;">
            <video id="video" autoplay muted></video>
            <canvas id="canvas"></canvas>
        </div>
        <form id="loginForm" method="post" enctype="multipart/form-data" action="http://localhost/atm_v100/your_endpoint">
            <input type="hidden" id="capturedImage" name="capturedImage">
        </form>
        <div id="status">Loading face detection models...</div>
        <div id="debug"></div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const loginForm = document.getElementById('loginForm');
        const capturedImage = document.getElementById('capturedImage');
        const status = document.getElementById('status');
        const debug = document.getElementById('debug');

        let isDetecting = false;

        function log(message) {
            console.log(message);
            debug.innerHTML += message + '<br>';
            debug.scrollTop = debug.scrollHeight;
        }

        async function loadFaceDetectionModels() {
            try {
                log('Loading face detection models...');
                await faceapi.nets.tinyFaceDetector.loadFromUri('http://localhost/atm_v100/assets/front/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('http://localhost/atm_v100/assets/front/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('http://localhost/atm_v100/assets/front/models');
                await faceapi.nets.faceExpressionNet.loadFromUri('http://localhost/atm_v100/assets/front/models');
                log('Face detection models loaded successfully');
                status.textContent = 'Face detection models loaded. Starting video...';
                startVideo();
            } catch (error) {
                console.error("Error loading models:", error);
                log('Error loading models: ' + error.message);
                status.textContent = "Error loading face detection models";
            }
        }

        function startVideo() {
            log('Attempting to start video...');
            navigator.mediaDevices.getUserMedia({ video: {} })
                .then(function (stream) {
                    video.srcObject = stream;
                    log('Camera access granted, video should start soon');
                })
                .catch(function (error) {
                    console.error("Could not access the camera:", error);
                    log('Error accessing camera: ' + error.message);
                    status.textContent = "Error: Could not access the camera";
                });
        }

        video.addEventListener('loadedmetadata', () => {
            log(`Video dimensions: ${video.videoWidth}x${video.videoHeight}`);
        });

        video.addEventListener('play', () => {
            log('Video started playing');
            const displaySize = { width: video.width, height: video.height };
            faceapi.matchDimensions(canvas, displaySize);
            detectFace();
        });

        async function detectFace() {
            if (isDetecting) return;
            isDetecting = true;

            try {
                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks();

                const resizedDetections = faceapi.resizeResults(detections, {
                    width: video.width,
                    height: video.height
                });

                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                faceapi.draw.drawDetections(canvas, resizedDetections);
                faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);

                if (detections.length > 0) {
                    log('Face detected');
                    status.textContent = "Face detected! Submitting form...";
                    captureAndSubmit();
                } else {
                    status.textContent = "Searching for face...";
                    isDetecting = false;
                    requestAnimationFrame(detectFace);
                }
            } catch (error) {
                console.error("Error in face detection:", error);
                log('Error in face detection: ' + error.message);
                status.textContent = "Error in face detection";
                isDetecting = false;
                requestAnimationFrame(detectFace);
            }
        }

        function captureAndSubmit() {
            log('Capturing image and submitting form');
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = video.videoWidth;
            tempCanvas.height = video.videoHeight;
            tempCanvas.getContext('2d').drawImage(video, 0, 0);
            capturedImage.value = tempCanvas.toDataURL('image/jpeg');
            loginForm.submit();
        }

        // Start the face detection process
        loadFaceDetectionModels();
    </script>