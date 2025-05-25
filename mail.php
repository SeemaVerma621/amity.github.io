<?php
if(isset($_POST['submit'])) {	

	$full_name=$_POST['full_name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$course=$_POST['course'];
	$state=$_POST['state'];
	$form_name=$_POST['form_name'];
	$source=$_POST['source'];
	$sub_source=$_POST['sub_source'];
	$utm_source=$_POST['utm_source'];
	$utm_campaign=$_POST['utm_campaign'];
	$utm_medium=$_POST['utm_medium'];
	$utm_term=$_POST['utm_term'];
	$page_url=$_POST['page_url'];


	// For CRM
	$url = 'https://sode.co.in/api/form/leads';
	$data = array(
		'full_name' => $full_name,
		'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'form_name' => $form_name,
		'source' => $source,
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term,
	);

	$postvars = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$response = curl_exec($ch);
	
	
	// Pabbly Connection For Brevo & Gallabox
	$url = 'https://connect.pabbly.com/workflow/sendwebhookdata/IjU3NjUwNTZhMDYzNDA0MzI1MjY4NTUzMzUxMzAi_pc';
    $data = array(
        'full_name' => $full_name,
	    'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'source' => 'Amity DES',
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term
    );

    $postvars = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, count($data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $response = curl_exec($ch);
	
	 // Second API request (with token and x-api-key)
$url = 'https://api.crm.sode.co.in/api/lead/apicreated';
$data = array(
    'name' => $full_name,
    'email' => $email,
    'phone' => $phone,
    'course' => $course,
    'state' => $state,
    'dob' => $dob,
    'source' => $source,
    'sub_source' => $sub_source,
    'utm_source' => $utm_source,
    'utm_campaign' => $utm_campaign,
    'utm_medium' => $utm_medium,
    'utm_term' => $utm_term,
);

// Add your token and x-api-key here
$token = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';
$api_key = 'a04b4291461f8b060559dfc965864c2c2590e6edd2f5aa7a49388484a1953f22';

$postvars = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Capture the response

// Add Authorization header with token and x-api-key
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $token",
    "x-api-key: $api_key",
    'Content-Type: application/x-www-form-urlencoded'
));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
	
	// For Google Sheet (Amity DES LP)
	$url = 'https://script.google.com/macros/s/AKfycbwuwp2bEqkBxHFkT75p4gyABmeFHNJP364rlT4QsT16WeXVo_8HRTDeKCHhvha9UKmwVA/exec';
	$data = array(
		'full_name' => $full_name,
		'email' => $email,
		'phone' => $phone,
		'course' => $course,
		'state' => $state,
		'form_name' => $form_name,
		'source' => $source,
		'sub_source' => $sub_source,
		'utm_source' => $utm_source,
		'utm_campaign' => $utm_campaign,
		'utm_medium' => $utm_medium,
		'utm_term' => $utm_term,
		'page_url' => $page_url,
	);

	$postvars = http_build_query($data);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); // Use $url instead of $url_mba
	curl_setopt($ch, CURLOPT_POST, count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$response = curl_exec($ch);

	
	// For Email
	if(isset($response) && $response) {
		$to = "seema@edgetechnosoft.com";
		$subject = "Enquiry From Amity LP";
		$message = 
			"Name: ".$full_name."\n".
			"Phone: ".$phone."\n".
			"Email: ".$email."\n".
			"Course: ".$course."\n".
			"State: ".$state."\n".
			"form_name: ".$form_name."\n".
			"source: ".$source."\n".
			"sub_source: ".$sub_source."\n".
			"utm_source: ".$utm_source."\n".
			"utm_campaign: ".$utm_campaign."\n".
			"utm_medium: ".$utm_medium."\n".
			"utm_term: ".$utm_term."\n".
			"page_url: ".$page_url;
		$headers = "From: support@onlinedegreecourses.co.in"; // Use \r\n for line breaks

		if(mail($to, $subject, $message, $headers)) {
			header('Location:thank-you');
			exit(); // Ensure to stop execution after redirection
		} else {
			echo "Email sending failed"; // Return an error message
			exit();
		}
	} else {
		echo "Response failed"; // Return an error message if API calls failed
		exit();
	}

} else {
	$response = array(
		'response' => 'error',
		'message' => 'POST is required to use this function'
	);
	echo json_encode($response); // Return a JSON response for missing POST data
	exit();
}
?>