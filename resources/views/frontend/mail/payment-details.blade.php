<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table td, table th {
            border: 1px solid black;
        }
        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
        }
         table td, table th {
            
            vertical-align: bottom;
            border-top: 1px solid black;
        }
        th{
            background-color: rgb(198,224,180);
             
        }
        #heading{
            background-color: rgb(68,84,106);
        }

    </style>
</head>
<body>
    <p>Dear {{ $name }},</p>
    <p>Thank You for showing interest in us. We are excited to have you in our Niveshaay family. Please find the payment details mentioned below:</p>
    <p style="color: red">*We request you to make payment by the same account holder as mentioned in the agreement form.</p>
    <table>
        <tr>
            <td colspan="2" id="heading">Payment Details</td>
        </tr>
        <tr>
            <th>Account Name</th>
            <td>Niveshaay Investment Advisors</td>
        </tr>
        <tr>
            <th>Bank Name</th>
            <td>Central Bank of India</td>
        </tr>
        <tr>
            <th>Account Number</th>
            <td>3639914984</td>
        </tr>
        <tr>
            <th>IFSC COde</th>
            <td>CBIN0284945</td>
        </tr>
        <tr>
            <th>Branch</th>
            <td>Vesu Branch</td>
        </tr>
        <tr>
            <th>City</th>
            <td>Surat</td>
        </tr>
        <tr>
            <th>Pin Code</th>
            <td>395007</td>
        </tr>
    </table>
    <div style="display:flex;flex-direction: row;">
        <div style="border:1px dotted grey;display:inline-flex;align-items:center">
            <img src="{{ $message->embed(base_path() . '/public/images/logo.png') }}" style="width:150px;"/>
            {{-- <img src="{{ asset('images/logo.png')}}" alt="" style="width:150px;"> --}}
        </div>
        <div style="border:1px dotted grey">
            <h3>CA Arvind Kothari</h3>
            <h3>Founder-Director, Niveshaay</h3>
            <p>+91 82003 84930 | www.niveshaay.com</p>
            <p>508 - SNS Platina, Near Someshwar Enclave, Vesu, Surat-395007</p>
        
        </div>
    </div>
    
</body>
</html>