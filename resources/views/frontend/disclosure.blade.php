@extends('frontend.layout.master')
@section('content')
    <div class="niveshaay-container">
        <h1 class="heading-title niveshaay-section-title">Investment Advisory Audits</h1>
        <p>“Disclosure with respect to compliance with Annual compliance audit requirement under Regulation 19(3) of SECURITIES AND EXCHANGE BOARD OF INDIA (INVESTMENT ADVISERS) REGULATIONS, 2013 for last and current financial year are as under :</p>
        <section class="niveshaay-section-paddding">
            <div class="table-responsive niveshhay-disclosure-table-responsive">
                <div class="table-wrapper">
                    <table class="table table-hover table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>Financial Year</th>
                                <th>Compliance Audit Status</th>
                                <th>Remarks, If any</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disclosures as $disclosure )
                                <tr>
                                    <td>{{ $disclosure->financial_year}}</td>
                                    <td>{{ $disclosure->audit_status }}</td>
                                    <td>{{ $disclosure->remarks }}</td>
                                </tr>    
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
                
            </div>
        </section>
    </div>
@endsection