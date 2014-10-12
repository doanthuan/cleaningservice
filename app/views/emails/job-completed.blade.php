<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Job Completed</h2>
<p>Hi {{$job->customer_name}}</p>
<p>
    Your job has been completed. Please let us know how your team did. Your feedback is important, so feel free to shoot
    us an email with more detailed feedback as well. If you any problem at all, we'll work to make it right.
</p>

<p>
    Thanks again!
</p>

<p>
    {{$teamName}} Customer Happiness Team
</p>

<h3>PLEASE TAKE A SECOND TO RATE YOUR CLEANING TEAM</h3>

<br/><br/>

<table style="width: 80%; text-align: center">
    <tr>
        <td>
            <a href="{{url('customer/user-feedback', array('id' => $job->job_id, 'rating' => 5))}}" style="text-decoration: none">
                <img src="{{$message->embed('img/smile1.png')}}">
                <div style="font-size: 22px; color: green;">It was great!</div>
            </a>
        </td>
        <td>
            <a href="{{url('customer/user-feedback', array('id' => $job->job_id, 'rating' => 3))}}" style="text-decoration: none">
                <img src="{{$message->embed('img/smile2.png')}}">
                <div style="font-size: 22px; color: #ffff00;">It was OK</div>
            </a>
        </td>
        <td>
            <a href="{{url('customer/user-feedback', array('id' => $job->job_id, 'rating' => 1))}}" style="text-decoration: none">
                <img src="{{$message->embed('img/smile3.png')}}">
                <div style="font-size: 22px; color: red;">It wasn't good</div>
            </a>
        </td>
    </tr>
</table>

</body>
</html>
