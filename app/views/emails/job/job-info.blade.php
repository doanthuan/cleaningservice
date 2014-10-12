<div>
    BOOKING-ID: {{str_pad($job->job_id, 10, '0', STR_PAD_LEFT)}} <br/>
    Name: {{$job->customer_name}} <br/>
    Email: {{$job->customer_email}} <br/>
    Phone: {{$job->customer_phone}} <br/>
    Address: {{$job->address}} <br/>
    City: {{$job->city}} <br/>
    State: {{$job->state}} <br/>
    Zip Code: {{$job->zipcode}} <br/>
    Date / Time: {{$job->take_time}} <br/>
    Payment Method: stripe <br/>
    Type of Service: {{$serviceTypeName}}<br/>
    Type of Service Price: ${{$serviceTypePrice}}<br/>
    Service Extras: {{$seList}}<br/>
    Frequency: {{$frequency}}<br/>
    <hr>
    Total Amount: ${{$amountBeforeDiscount}}<br/>
    
    @if ($frequency_int > 1)
    Total Amount After Discount: ${{($job->amount + $job->giftcard_amount)}}<br/>
    @endif

    Gift Amount: ${{$job->giftcard_amount  or '0.00'}}<br/>
    Total After Gift Amount: ${{$job->amount}}
</div>