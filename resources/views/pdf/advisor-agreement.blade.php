<!DOCTYPE html>
<html>
<head>
    <title>advisor agreement</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ public_path('css/pdf.css') }}" rel="stylesheet">
    <style>
        @media  screen,
        print {
            @page  {
                margin: 20px 0;
            }
            * {
                -webkit-box-sizing: border-box;
                box-sizing: border-box;
            }
            table {
                border-collapse: collapse;
            }
            table td {
                border: none;
            }
            .confirm-img { 
                width: 100px;
            }
            .confirm-img img {
                width: 100px;
            }
            .advisor-header-block, .advisor-detail-table-wrapper  {
                padding: 0 30px;
            }
            .advisor-header-block .pdf-heading {     
                font-size: 20px;
                font-weight: bold;
                line-height: 1.2;
                margin-bottom: 52px;
                color: #3b3b3b;
            }
            .advisor-detail-table-wrapper .advisor-detail-table-inner {
                background-color: #fff;
                border: 1px solid #e1e1e1;
            }
            .advisor-detail-table-wrapper .advisor-detail-table-inner .detail-block.has-no-border{
                border-bottom: 0;
                padding: 25px 20px 20px;
            }
            .advisor-detail-table-wrapper .advisor-detail-table-inner .detail-block {
                padding: 10px 20px 20px;
                border-bottom: 1px solid #e1e1e1;
            }
            .advisor-detail-table-wrapper .advisor-detail-table-inner .detail-block.risk-profile-section {
                padding: 10px 20px 20px;
            }
            .detail-block h2 {
                font-size: 16px;
                font-weight: bold;
                color: #313131;
                margin-bottom: 18px;
                font-family: "Playfair Display",serif;
            }
            .detail-title {
                color: #888;
                font-family: 'Open Sans',sans-serif;
                line-height: 1.38;
                display: block;
                font-size: 12px;
            }
            .detail-title.bold-title {
                color: #212121;
                font-weight: bold;
            }
            .detail-text {
                color: #222121;
                font-weight: normal;
                line-height: 1.38;
                font-size: 14px;
                font-family: 'Open Sans',sans-serif;
            }
            .advisor-body-wrapper .cms-content { 
                padding: 0 30px;
            }
            .advisor-body-wrapper .cms-content h2 {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 16px;
                color: #83b645;
                font-family: 'Open Sans',sans-serif;
            }
            .advisor-body-wrapper .cms-content h3 {
                font-size: 16px;
                margin-bottom: 12px;
                font-family: 'Open Sans',sans-serif;
            }
            .advisor-body-wrapper .cms-content p, .advisor-body-wrapper .cms-content ul li, .advisor-body-wrapper .cms-content ol li {
                font-weight: normal;
                line-height: 1.75;
                font-size: 12px;
                color: #000;
                font-family: 'Open Sans',sans-serif;
            }
            .advisor-body-wrapper .cms-content ul, .advisor-body-wrapper .cms-content ol, .advisor-body-wrapper .cms-content p {
                margin-bottom: 15px;
            }
            .advisor-body-wrapper .cms-content ul li + li, .advisor-body-wrapper .cms-content ol li+ li {
               margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="advisor-body-wrapper">
        <div class="advisor-header-block">
            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                <tbody>
                    <tr>
                        <td height="50"></td>
                    </tr>
                    <tr>    
                        <td>
                            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="50%" class="pdf-heading">Investor advisor agreement</td>
                                        <td width="50%">
                                            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td width="150">
                                                            <em  height="100" width="150" class="confirm-img"><img width="150" src="{{ public_path('images/confirm.svg') }}" alt="confirm-img" style="display:inline"></em> 
                                                        </td>
                                                        <td width="25"></td>
                                                        <td width="25%">
                                                            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                                                                <tbody>
                                                                        <tr>
                                                                            <td class="detail-text">Digitally confirmed via OTP</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="detail-text">{{ $name_of_investor}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="10"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="detail-text">{{ date("F d Y H:i:s A");}}</td>
                                                                        </tr>
                                                                </tbody> 
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="70"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="image-wrapper" style="padding:30px; text-align: center;">
            <img src="{{ public_path('images/logo.png') }}" alt="" style="width:150px;height: auto;"/>
        </div>
        <div class="advisor-detail-table-wrapper">
            <div class="advisor-detail-table-inner">
                    <div class="detail-block">
                        <h2>ADVISOR DETAILS</h2>
                        <div class="detail-block-table">
                            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                                <tbody>
                                    <tr>
                                        <td width="40%" class="detail-title">
                                             Name
                                        </td>
                                        <td width="10"></td>
                                        <td width="30%" class="detail-title">
                                             Email
                                        </td>
                                        <td width="10"></td>
                                        <td width="30%" class="detail-title">
                                             SEBI Registration>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="5"></td>
                                    </tr>
                                    <tr>
                                        <td class="detail-text">
                                            NIVESHAAY INVESTMENT ADVISORS
                                        </td>
                                        <td width="10"></td>
                                        <td class="detail-text">
                                            Info@niveshaay.com
                                        </td>
                                        <td width="10"></td>
                                        <td class="detail-text">
                                            INA000008552
                                        </td>
                                    </tr>
                                </tbody>      
                            </table>       
                        </div>
                    </div>
                    <div class="detail-block has-no-border">
                        <h2>CLIENT DETAILS</h2>
                        <div class="detail-block-table">
                                <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="40%" class="detail-title">Name</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-title">Service Name</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-title">Subscription Start Date</td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="detail-text">{{ $name_of_investor }}</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-text">Research report subscription</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-text">{{ $subscription_start_date }}</td>
                                        </tr>
                                        <tr>
                                            <td height="30"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="detail-title">Email</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-title">Subscription Fee</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-title">Subscription End Date</td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="detail-text">{{ $email }}</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-text"><div class="rupee-block"><em class="rupee-icon" style=""><img width="5" src="{{ public_path('images/rupee-icon.png') }}" alt="rupee-icon" style="display:inline"></em> {{ $amount }}</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-text">{{ $subscription_end_date }}</td>
                                        </tr>
                                        <tr>
                                            <td height="30"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="detail-title">PAN</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-title">Fee Frequency</td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                        <tr>
                                            <td width="40%" class="detail-text">{{ $pan_no }}</td>
                                            <td width="10"></td>
                                            <td width="30%"  class="detail-text">{{ $fees_frequency }}</td>
                                        </tr>
                                    </tbody>      
                                </table>       
                        </div>
                    </div>
                    <div class="detail-block has-no-border risk-profile-section">
                        <div class="detail-block-table">
                            <table class="table" cellspacing="0" cellpadding="0" style="width: 100%;" width="100%" > 
                                    <tbody>
                                        <tr> 
                                            <td class="detail-title bold-title" >RISK PROFILING</td>
                                            <td class="detail-title bold-title" style="text-align:right; width: 250px;">SEBI REGISTRATION</td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-text">{{ $riskprofile }}</td>
                                            <td class="detail-text" style= "text-align:right; width: 250px;">INA000008552</td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
            </div>
        </div>
        <div class="cms-content">
            <p class="context-text">In this Agreement , unless the context otherwise requires, the Client and the Investment Adviser shall each be individually referred to as 
                a “Party” and shall be collectively referred to as the “Parties”.
            </p>
            <h3><strong>WHEREAS:</strong></h3>
            <ul> 
                <li>The Client seeks to appoint advisor(s) to provide certain investment advisory and other related services in relation to the model portfolios of securities and has requested the Investment Adviser to render investment advisory services to it at his/her/ its risk.</li>
                <li> The Investment Adviser has agreed to be appointed as the Investment Adviser to the Client in accordance with the terms of this Agreement and SEBI       
                (Investment Advisers) Regulations, 2013 as amended from time to time (“IA Regulations”) to provide with investment advisory services on a non-binding
                and non-exclusive basis and in a manner solely determined by itself.</li>
            </ul>
            <h2 class="green-title">1. REPRESENTATIONS AND WARRANTIES BY THE PARTIES</h2>
            <h3><strong>The Parties hereto represent, warrant, and covenant to each other that:</strong></h3>
            <p>1.1	Each of the Parties are duly formed and validly existing under the respective laws that they are subject to with full power and authority to conduct the business as contemplated in this Agreement.</p>
            <p>1.2	Each Party has full power, capacity and authority to execute, deliver and perform this Agreement and has taken all necessary action (corporate, 
            statutory or otherwise) to authorize the execution, delivery and performance of this Agreement.
            </p>
            <p>1.3	This Agreement and each other agreement executed in connection herewith, if any, have been duly executed and delivered by each Party and constitute legal, valid and binding obligations of such Party, enforceable against the other Party in accordance with the terms.</p>
            <p>1.4	Each Party has obtained and complied with all clearances, permissions, approvals, conditions and notices, that are or have been required, for the due execution and delivery of, and performance under this Agreement.</p>
            <p>1.5	Client Undertaking</p>
            <p>The Client understands and consents that it/he/she:</p>
            <p>1.5.1	have read and understood the terms and conditions of investment advisory services provided by the Investment Adviser and also understood the fee structure and mechanism for charging and payment of fees as under this Agreement.</p>
            <p>1.5.2	wants to avail the investment advisory services only for himself / herself and not for any other person.</p>
            <p>1.5.3	have, based on its written request to the Investment Adviser, been provided the opportunity by the Investment Adviser to ask questions and interact with ‘person(s) associated with the investment advice.</p>
            <p>1.5.4	has read the terms and conditions of Investment Advisory services provided by the Investment Adviser along with the fee structure and mechanism for charging and payment of fee. Further, the Investment Adviser based on the Client’s request in writing provided the Client an opportunity to ask questions and interact with person(s) associated with the investment advice.</p>
            <p>1.5.5	shall furnish any and all information as reasonably requested by the Investment Adviser for the purpose of risk profiling process. The risk profile as created by the Investment Adviser shall be final and binding on the Client and the Client consents to the Investment Adviser utilizing such information for the purpose of rendering investment advice services to the Client.</p>
            <p>1.6	Representations by the Investment Adviser</p>
            <p>1.6.1	The Investment Adviser shall ensure that it has appointed personnel of appropriate qualifications and experience to perform the services in order to fulfil its obligations under this Agreement.</p>
            <p>1.6.2	Investment Adviser shall neither render any investment advice nor charge any fee until the Client has signed this Agreement.</p>
            <p>1.6.3	The Investment Adviser represents and warrants that it shall only recommend direct implementation of advice i.e. through direct schemes/direct codes where no consideration (including any embedded/indirect/in kind commission or referral fees by any name) is received directly or indirectly by the Investment Adviser or his /her family.</p>
            <p>1.6.4	Investment Adviser shall not manage funds and securities on behalf of the client and that it shall only receive such sums of monies from the client as are necessary to discharge the client’s liability towards fees owed to the Investment Adviser.</p>
            <p>1.6.5	Investment Adviser shall not, in the course of performing its services to the Client, hold out any investment advice implying any assured returns or minimum returns or target return or percentage accuracy or service provision till achievement of target returns or any other nomenclature that gives the impression to the Client that the investment advice is risk free and/or not susceptible to market risks and or that it can generate returns with any level of assurance.</p>
            <p>1.6.6	The Investment Adviser represents and warrants that it is carrying on its activities on an arms-length relationship between its activities as an Investment Adviser and other activities and such arm’s length relationship shall be maintained while the existence of this Agreement.</p>
            <p>1.6.7	The Investment Adviser represents and warrant that it is carrying on its activities independently, at an arms-length basis with its related parties. Disclosure of conflicts of interests, if any, shall be made by the Investment Adviser to the Client in a prompt manner.</p>
            <p>1.6.8	The Investment Adviser represents and warrants that all appropriate registrations permissions and approvals which are statutorily required, have been validly maintained and shall continue to be in force as required for the performance of the Investment Adviser’s obligations under this Agreement.</p>
            <p>1.6.9	The Investment Adviser shall not derive any direct or indirect benefit out the Client’s securities and/or investment products.</p>
            <p>1.6.10	The Investment Adviser shall ensure that it will take all consents and permissions from the Client prior to undertaking any actions, including but not limited to implementation services in relation to the securities or investment products advised by the Investment Adviser, in a form and manner as under the IA Regulations.</p>
            <p>1.6.11	The Investment Adviser represents and warrants that it shall not provide any distribution services to the Client.</p>
            <p>1.6.12	The Investment Adviser represents and warrants that its family/group companies shall not provide distribution services to the Client advised by the Investment Adviser, for securities and investment products.</p>
            <p>1.6.13	The Investment Adviser represents and warrants that its family/ group shall not provide investment advisory services to the Client who receives distribution services from the other family members of the Investment Adviser.</p>
            <p>1.6.14	The Investment Adviser represents and warrants that it shall not provide investment advisory services, for securities and investment products, to a Client who is receiving distribution services from its family members/ group.</p>
            <p>1.6.15	The investment adviser represents and warrants that it shall maintain client records and data as mandated under the securities and exchange board of India (Investment Adviser) Regulations 2013.</p>
            <!-- <p>For the purposes of this Agreement, “family members and group” shall have the meaning ascribed to it under the IA Regulations.</p> -->
            <h2 class="green-title">2. SCOPE OF SERVICES</h2>
            <p>2.1 The Client hereby engages the services of the Investment Adviser and the Investment Adviser hereby agrees, as an independent contractor and on a principal to principal basis, to provide the model portfolio services.</p>
            <p>2.2 The services rendered by the Investment Adviser shall take into account the risk capacity and risk aversion determined through a proper risk profiling process and accepted by the Client.</p>
            <p>2.3 Notwithstanding anything herein contained to the contrary, the Parties hereby agree that the services to be rendered by the Investment Adviser to the Client are merely recommendatory, non-binding in nature.</p>
            <p>2.4 The Parties acknowledge that the Investment Adviser will not assume any management responsibilities in connection with the services. Further, the Investment Adviser will not be responsible for the use or implementation of the output of the services provided pursuant to this Agreement.</p>
            <p>2.5 The Investment Adviser shall use its best judgment and efforts in rendering advice to the Client under this Agreement and in the performance of all its powers and duties under this Agreement.</p>
            <p>2.6 It is hereby expressly understood and confirmed by the Client and the Investment Adviser that notwithstanding any other provision of this Agreement, neither the Investment Adviser nor any of its directors or employees shall have the power or authority whatsoever to:</p>
            <p>2.6.1 Bind or commit the Client in relation to any contract or any trade or other preliminary or ancillary agreement relating thereto.</p>
            <p>2.6.2 Represent the Client in any way, including without limitation, in any negotiations relating to the purchase, acquisition, sale or transfer of any investments.</p>
            <p>2.6.3 Buy or sell any securities on behalf of the Client.</p>
            <p>2.7 The services to be provided by the Investment Adviser shall be subject to the activities permitted under the Securities and Exchange Board of India (Investment Advisers) Regulations, 2013. The Investment Adviser shall act in a fiduciary capacity towards the Client at all times.</p>
            
            <h2 class="green-title">3. FUNCTIONS AND DUTIES OF THE INVESTMENT ADVISER</h2>
            <p>3.1 The Investment Adviser, in relation to providing services to the Client, undertakes to always abide by the IA Regulations (including compliance requirements under the IA Regulations) and rules, circulars and notifications issued there under from time to time</p>
            <p>3.2 The Investment Adviser undertakes to always abide by the eligibility criteria as under the IA Regulations.</p>
            <p>3.3 The Investment Adviser shall provide a risk assessment procedure to client including determination of risk capacity and risk aversion levels</p>
            <p>3.4 The Investment Adviser shall provide reports in relation to potential and current investments.</p>
            <p>3.5 The Investment Adviser shall, in relation to each Client maintain, know your client, advice, risk assessment, analysis reports of investment advice and suitability, terms and conditions document, rationale of advice, related books of accounts and a register containing list of clients along with dated investment advice in compliance with the IA Regulations.</p>
            <p>3.6 The Investment Adviser shall conduct compliance audits with respect to itself to ensure that it is in compliance with the IA Regulations in a form and manner as may be prescribed under the IA Regulations from time to time.</p>
            <p>3.7 The Investment Adviser shall ensure there is adequate compliance and monitoring processes in place for the purposes of client segregation in a form and manner as may prescribed under the IA Regulations from to time.</p>
            <p>3.8 The Investor Advisor undertakes to abide by the code of conduct as specified under the IA Regulations and such shall be deemed to incorporated within this Agreement by reference.</p>
            
            <h2 class="green-title">4. ADVISORY FEE</h2>
            <p>4.1 The Client shall pay the Investment Adviser by way of remuneration for its services such fees as specified at the beginning of the agreement in accordance with the IA Regulations and relevant circulars issued there under</p>
            <p>4.2 In case, the Investment adviser is charging the fee on a percentage of AUA basis, the Investment Adviser shall refer the Client’s monthly holding statement as referred to in point 4.3 below for the calculation of the fee</p>
            <p>4.3 In case, the Investment Adviser is charging on a percentage of AUA basis, the Client shall bring to the notice of the Investment Adviser any discrepancy in the monthly holding statement shared by the Investment Adviser within 7 days from the date of the statement, failing which it shall be presumed that the Client has confirmed its completeness and correctness. The Client agrees to provide the Investment Adviser with necessary supporting documents related to the AUA, as and when required</p>
            <p>4.4 The client shall pay the fee within 7 days from receiving the invoice from the Investment Adviser on the registered email id.</p>
            <p>4.5 The Investment Adviser shall send a receipt evidencing payment of Advisory Fees by the Client to the Client’s registered email address.</p>
            <p>4.6 The Advisory Fee shall be paid by the Client to the Investment Adviser by depositing the same in the bank account of the Investment Adviser as may be notified by the Investment Adviser. The Advisory Fee shall not be accepted in cash by the Investment Adviser.</p>
            <p>4.7 The Investment Adviser confirms that the fees shall at all times be calculated and charged in accordance with IA Regulations and circulars issued thereunder</p>
            <p>4.8 The Client shall be additionally charged all taxes as may be applicable or as may be levied in relation to the consideration payable to the Investment Adviser. It is hereby clarified that the Investment Adviser shall be responsible for payment of income tax and similar levies payable by it.</p>
            <p>4.9 A sample illustration for calculation of fee is given below
                <p>Formula for the calculating the fee on percentage of AUA basis has been explained below:
                    (Average daily AuA in the month) * (Number of invested days in the month/360) * Subscription fee (in %) Sample calculation: 100,000 (Avg. daily AuA) * (30/360) *.02 (subscription fee as %) = INR 166.67
                    Fixed fee will be charged as a fixed amount during the subscription at the beginning of the subscription</p>

            </p>
            <p>4.10 Below are the SEBI guidelines for advisory fees as specified in the SEBI circular dated 23rd Sep 2020.</p>
            <p>Fees Regulation 15 A of the amended IA Regulations provide that Investment Advisers shall be entitled to charge fees from a client in the manner as specified by SEBI, accordingly Investment Advisers shall charge fees from the clients in either of the two modes:
                (A) Assets under Advice (AUA) mode
    
                a. The maximum fees that may be charged under this mode shall not exceed 2.5 percent of AUA per annum per client across all services offered by IA.
                b. IA shall be required to demonstrate AUA with supporting documents like demat statements, unit statements etc. of the client.
                c. Any portion of AUA held by the client under any pre-existing distribution arrangement with any entity shall be deducted from AUA for the purpose of charging fee by the IA.
                (B) Fixed fee mode
                
                The maximum fees that may be charged under this mode shall not exceed INR 1,25,000 per annum per client across all services offered by IA.
                General conditions under both modes
                
                a. IA shall charge fees from a client under any one mode i.e. (A) or (B) on an annual basis. The change of mode shall be effected only after 12 months of on boarding/last change of mode.
                b. If agreed by the client, IA may charge fees in advance. However, such advance shall not exceed fees for 2 quarters.
                c. In the event of pre-mature termination of the IA services in terms of agreement, the client shall be refunded the fees for unexpired period. However, IA may retain a maximum breakage fee of not greater than one quarter fee.</p>

            <h2 class="green-title">5. INVESTMENT OBJECTIVES AND GUIDELINES AND RISK FACTORS</h2>
            <p>5.1 Type of securities – model portfolio services provided by the investment adviser under this agreement would be based on stocks and ETFs listed on the Indian Stock Exchanges.</p>
            <p>5.2 Strategy – recommendation follows a model portfolio approach where the portfolio composition is reviewed at a fixed frequency based on various quantitative, technical or fundamental factors to determine the portfolio composition for the next period.</p>
            <p>5.3 Tax Aspects – equity component of the portfolio would be subjected to short term/long term capital gains tax depending on the holding period of the security. If the holding period is less than one year, a 15% short term capital gains tax would be applicable. If the holdings period is more than one year, a 10% long term capital gains tax would be applicable on portfolio gains. These rates can be revised on a time to time basis by the government of India. Tax liability on the ETF component of the portfolio, if any, would depend on the underlying asset class of the ETF. When in doubt, client shall reach out to the Investment Advisor on the mentioned email id for a detailed evaluation based on the trades placed by the client.</p>
            <p>5.4 Investment Objectives and Guidelines and risk factors - The Client hereby agrees and understands that investment advice made by the Investment Adviser are subject to various market, currency, economic, political and business risks including but not limited to price and volume volatility in the stock markets, interest rates, currency exchange rates, foreign investments, changes in government policies, taxation, political, economic, pandemic, or other developments and closure of the stock exchange</p>
            
            <h2 class="green-title">6. NO RIGHT TO SEEK POWER OF ATTORNEY</h2>
            <p>The Investment Adviser hereby declares and confirms that it shall not seek any power of attorney or authorizations from the Client for implementation of investment advice.</p>

            <h2 class="green-title">7. SERVICES NOT EXCLUSIVE</h2>
            <p>The services of the Investment Advisor are not exclusive to the Client. The Investment Advisor and any shareholder, employee, director or agent of the Investment Advisor may render similar services to others and engage in additional activities, without any intimation to, or consent of the Client. Provided however that the Investment Advisor as well as any of its directors, employees of associate concerns shall avoid any conflict of interest in relation to the advisory services provided.</p>
            <p>In the event that such a conflict of interest does arise, the Investment Adviser shall declare such conflict and, if reasonably possible, ensure that fair treatment on an arm’s length basis as reasonably determined by the Investment Adviser in its sole discretion shall be accorded to the Client. For the avoidance of doubt, the Investment Advisor may, from time to time have business relationships with companies or corporations in relation to which advisory services have been provided to the Client.</p>
            <h2 class="green-title">8. DURATION AND TERMINATION</h2>
            <p>8.1 The Agreement shall remain in force for the period mentioned at the beginning of this agreement.</p>
            <p>8.2 If the client is on an auto-renew plan, the agreement will remain in force until the subscription is canceled by the client or advisor in accordance with this agreement.</p>
            <p>8.3 This Agreement may be terminated by mutual agreement of the Client and the Investment Adviser by giving a 30 days prior written notice.</p>
            <p>8.4 The Agreement may be immediately terminated by the Investment Adviser: (i) if the Client breaches any material term of this Agreement; or (ii)if the Client is admitted into liquidation (except a voluntary liquidation for the purpose of reconstruction or amalgamation) or commits any act of bankruptcy or if a receiver is appointed in respect of any assets of the Client.</p>
            <p>8.5 If the Investment Adviser ceases to hold statutory licenses and/or registrations required to provide services as contemplated under this Agreement then the Client shall have the ability to terminate this Agreement without any further consequences.</p>
            <p>8.6 If the Government or any regulatory body has taken any action on the Investment Adviser then the Client shall have the right to immediately terminate this Agreement.</p>
            <p>8.7 The agreement will be terminated automatically upon the death of the Client.</p>
            <p>8.8 Upon the termination of the Agreement due to reasons under Clause 8.3, 8.4, 8.5,8.6 and 8.7, the Investment Adviser shall refund any balance of the advisory fees for which services have not been provided within 30 business days from the date of termination of this agreement.</p>
            <p>8.9 Any Advisory Fees that have accrued in the manner set out in this Agreement up to the date of the termination shall be paid by the Client to the Investment Adviser within Thirty (30) business days from the date of termination of this Agreement.</p>

            <h2 class="green-title">9. LIMITATION OF LIABILITY OF THE INVESTMENT ADVISER</h2>
            <p>9.1 The Investment Adviser shall not be liable towards the Client by reason of any loss, which a Client may suffer by reason of any depletion in the value of the investment and/or ‘assets under advice’, which may result by reason of fluctuation in asset value, or by reason of non-performance or under-performance of the securities/funds or any other market conditions.</p>
            <p>For the purposes of this Agreement, “Assets Under Advice” shall have the meaning ascribed to under the IA Regulations.</p>

            <h2 class="green-title">10. NOTICE</h2>
            <p>10.1 Any notice, instruction, recommendation or other communication to be given hereunder shall be in writing and delivered by e-mail addressed to the Party for which it is intended A communication sent by e-mail shall be deemed to have been received at the close of business on the day on which it is sent In providing service by e-mail, it shall be sufficient to show that the email was properly addressed to the intended recipient.</p>
            <p>10.2 Whenever, pursuant to any provision of this Agreement, any notice, instruction, recommendation or other communication is given to either Party, the Client or the Investment Adviser (as the case may be) may accept as sufficient evidence thereof a document signed or purporting to be signed by such person or persons as shall be authorised from time to time in that behalf by the Client or the Investment Adviser (as the case may be).</p>
            <p>10.3 Whenever, pursuant to any provision of this Agreement, any notice, instruction, recommendation or other communication is given to either Party, the Client or the Investment Adviser (as the case may be) may accept as sufficient evidence thereof a document signed or purporting to be signed by such person or persons as shall be authorised from time to time in that behalf by the Client or the Investment Adviser (as the case may be).</p>

            <h2 class="green-title">11. ASSIGNMENT</h2>
            <p>This Agreement may not be assigned by either Party without the written consent of the other Party.</p>

            <h2 class="green-title">12. WHOLE AGREEMENT</h2>
            <p>This Agreement together with any document annexed hereto or referred to herein constitutes the entire Agreement between the Parties in relation to the subject matter hereof and supersedes all prior understandings, arrangements, representations, proposals or communications between the Parties whether written or oral.</p>

            <h2 class="green-title">13. SEVERABILITY</h2>
            <p>In the event that any term, condition or provision of this Agreement is held to be in a violation of any applicable law, statute or regulation the same shall be deemed to be deleted from this Agreement and shall be of no force and effect and this Agreement shall remain in full force and effect as if such term, condition or provision had not originally been contained in this Agreement. Notwithstanding theforegoing in the event of such deletion the Parties shall negotiate in good faith in order to agree on the terms of a mutually acceptable and satisfactory alternative provision in place of the provision so deleted.</p>

            <h2 class="green-title">14. GRIEVANCE REDRESSAL AND DISPUTE RESOLUTION</h2>
            <p>14.1 In the event any Client has any grievances in relation to the provision of investment advice and related services by the Investment Adviser, it shall be the responsibility of the Investment Adviser to resolve the grievances promptly but not later than a period of thirty (30) days from the date such grievance or such time period as may be prescribed by SEBI from time to time.</p>
            <p>14.2 In the event of any dispute arising between the Parties in relation to this Agreement, the Parties shall in the first instance attempt to resolve such dispute by mutual discussions. If the dispute is not resolved through mutual consultations within thirty (30) calendar days after one Party has served written notice on the other Party requesting the commencement of such discussions, either Party may in writing demand that the dispute be finally settled by the arbitration of one (1) arbitrator, who shall be appointed based on the mutual agreement of the Parties. The arbitration shall be conducted in accordance with the Arbitration and Conciliation Act, 1996 and the rules thereunder, as may be amended from time to time.</p>
            <p>14.3 The language of arbitration shall be English.</p>
            <p>14.4 The arbitration award shall be final and binding upon the Parties. Each Party shall co-operate in good faith to expedite (to the maximum extent practicable) the conduct of any arbitral proceedings commenced under this Agreement.</p>
            <p>14.5 The costs and expenses of the arbitration, including, the fees of the third arbitrator, shall be borne equally by each Party to the dispute or claim and each Party shall pay its own fees, disbursements and other charges of its counsel and the arbitrators nominated by it.</p>
            <p>14.6 The arbitrator would have the power to award interest on any sum awarded pursuant to the arbitration proceedings and such sum would carry interest, if awarded, until the actual payment of such amounts. Any award made by the arbitrators shall be final and binding on each of the Parties that were parties to the dispute.</p>

            <h2 class="green-title">15. FORCE MAJEURE</h2>
            <p>The Investment Adviser shall not be liable for delays or errors occurring by reason of circumstances beyond its control, including but not limited to acts of civil or military authority, national emergencies, work stoppages, fire, flood, catastrophe, acts of God, insurrection, war, riot, or failure of communication or power supply. In the event of equipment breakdowns beyond its control, the Advisor shall take reasonable steps to minimize service interruptions but shall have no liability with respect thereto.</p>

            <h2 class="green-title">16. MISCELLANEOUS</h2>
            <p>16.1 The Investment Adviser shall not seek any power of attorney or authorizations from the Client for automatic implementation of investment advice and nothing in this Agreement shall be construed as conferring a power of attorney or such rights by the Client on the Investment Adviser.</p>
            <p>16.2 Any amendment to the terms hereof shall be effective only if agreed to in writing between the Client and the Investment Adviser.</p>
            <p>16.3 No failure on the part of any Party to exercise, and no delay in exercising, any right or remedy under this Agreement will operate as a waiver thereof nor will any single or partial exercise of any right or remedy preclude any other or further exercise thereof or the exercise of any other right or remedy. The rights and remedies provided in this Agreement are cumulative and not exclusive of any rights or remedies provided by law.</p>
            <p>16.4 The illegality, invalidity or unenforceability of any provision of this Agreement under the laws of any jurisdiction shall not affect its legality, validity or enforceability under the laws of any other jurisdiction nor the legality, validity or enforceability of any other provision.</p>
            <p>16.5 Other than as specifically permitted under this Agreement, the Client shall not publish, disseminate or broadcast advertisements, circulars or other publicity material referring to the other Party without the prior consent of such Party, which shall not be unreasonably withheld.</p>
            <p>16.6 Nothing herein contained shall be deemed to create or constitute a partnership between the Parties hereto. This Agreement may only be varied with the written agreement of both Parties. This Agreement may be entered into in any number of counterparts, each of which when executed and delivered shall be an original.</p>
            <p>16.7 No Person who is not a party to this Agreement shall have any right to enforce the terms of this Agreement.</p>
            <p>16.8 Each party agrees to perform such further actions and execute such further agreements as are necessary to effectuate the purposes hereof.</p>

            <h2 class="green-title">17. DISCLOSURES BY THE INVESTMENT ADVISER</h2>
            <p>17.1 The Investment Adviser has a contractual arrangement with a vendor - Smallcase Technologies Private Limited (STPL); whereby STPL provides technology solutions and related back-end infrastructure along with support for back- office related operations & processes.</p>
            <p>17.2 The Investment Adviser also offers a mechanism to facilitate transactions on the recommendations provided to the client through STPL. The investment adviser does not receive any commission, fees or any other type of remuneration from the STPL for the same. The client is free to use the service as per his/her own discretion.</p>
            <p>17.3 STPL shall prepare a holding statement summary of the Client’s securities at the end of each month on a monthly basis and shall email the same to the Client’s registered email address on behalf of the Investment Adviser with a copy to the Investment Adviser. This statement will be prepared basis the transactions done by the Client through or from the website and or mobile application of the Investment adviser and facilitated by the STPL.</p>
            <p>17.4 The Client agrees and confirms that the Service Provider may appoint agents and or third-party vendors for carrying out the acts mentioned in or in relation to rendering its services. The Client consents to sharing of his/its account related information to such authorised agents / third party vendors appointed by the Service Provide.</p>

            <h2 class="green-title">18. Place of arbitration</h2>
            <p>The seat of arbitration shall be Surat, Gujarat, India.</p>

            <h2 class="green-title">19. Indemnity Limit</h2>
            <p>The liability of the Investment Adviser towards the Client shall be limited to the Advisory Fees as received by the Investment Adviser for a period of 6 preceding months from the date on which the claim in relation to actions of proven fraud, gross negligence, willful default in connection with discharge of duties of the Investment Adviser arises.</p>

            <h2 class="green-title">20. Refund policy</h2>
            <p>Upon the termination of the Agreement due to reasons by the written consent of Client and Investment Advisor
                , the Investment Adviser shall at its own discretion (as applicable) provide refund of any balance of the Advisory Fees for which Services have not been provided</p>
        </div>
    </div>
</body>