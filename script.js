
$(document).ready(function() {
 
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const timeInButton = document.getElementById('time_in');
    const timeOutButton = document.getElementById('time_out');
    const responseDiv = document.getElementById('response');
    const loadingDiv = document.getElementById('loading');
    timeInButton.style.display = 'none';
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
        video.srcObject = stream;
        video.play();
    })
    .catch(function(err) {
        console.error('Error accessing the webcam:', err);
    });

    captureButton.addEventListener('click', function() {
        
        // Show loading animation
        loadingDiv.style.display = 'block';
        //hide time_in
        timeInButton.style.display = 'none';
        timeOutButton.style.display = 'none';
        //clear response
        responseDiv.innerHTML = "";
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageData = canvas.toDataURL('image/png');

        $.ajax({
            url: 'process_image.php',
            type: 'POST',
            data: { image_data: imageData },
            success: function(response) {
                responseDiv.innerHTML = response;
                // Hide loading animation
                loadingDiv.style.display = 'none';
                //show time_in button
                timeInButton.style.display = 'block';
                timeOutButton.style.display = 'block';
            },
            error: function(xhr, status, error) {
                console.error('Error sending image:', error);
                // Hide loading animation
                loadingDiv.style.display = 'none';
            }
        });
    });

    timeInButton.addEventListener('click', function() {
        // Extract emp_id from the response
        const responseText = responseDiv.innerHTML;
        const empIdIndex = responseText.indexOf('ID number: ') + 'ID number: '.length;
        const empId = responseText.substring(empIdIndex, responseText.indexOf('<', empIdIndex));
        //alert(empId);
        // Show loading animation
        loadingDiv.style.display = 'block';
        // Call insert_time_record.php with emp_id as parameter
        $.ajax({
            url: 'emp_time_in_v2.php',
            type: 'POST',
            data: { emp_id: empId },
            success: function(response) {
                alert(response);
                // Hide loading animation
                loadingDiv.style.display = 'none';
                //hide time_in button
                timeInButton.style.display = 'none';
            },
            error: function(xhr, status, error) {
                console.error('Error sending time in request:', error);
            }
        });
    });

    timeOutButton.addEventListener('click', function() {
        // Extract emp_id from the response
        const responseText = responseDiv.innerHTML;
        const empIdIndex = responseText.indexOf('ID number: ') + 'ID number: '.length;
        const empId = responseText.substring(empIdIndex, responseText.indexOf('<', empIdIndex));
        //alert(empId);
        // Show loading animation
        loadingDiv.style.display = 'block';
        // Call time_out.php with emp_id as parameter
        $.ajax({
            url: 'emp_time_out_v2.php',
            type: 'POST',
            data: { emp_id: empId },
            success: function(response) {
                alert(response);
                // Hide loading animation
                loadingDiv.style.display = 'none';
                //hide time_in button
                timeOutButton.style.display = 'none';
            },
            error: function(xhr, status, error) {
                console.error('Error sending time in request:', error);
            }
        });
    });



});
