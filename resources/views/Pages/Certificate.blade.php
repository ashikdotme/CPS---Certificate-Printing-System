<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">  --}}
    <style>
.container {
  max-width: 750px;
  width: 100%;
  text-align: center;
  margin: auto;
}
.certificate h1 {
	font-weight: 700;
	font-size: 28px;
	color: #303188;
	/* margin: 35px 25px; */
	/* padding-top: 70px; */
	margin-bottom: 0;
	margin-top: 25px;
}
.certificate p {
	margin: 0;
	font-size: 35px;
	margin-top: 10px;
}
.certificate-text {
  position: relative;
}
.certificate-text::after {
  position: absolute;
  content: "";
  right: 50px;
  top: -17px;
  width: 65px;
  height: 90px;
  background: url(../images/123.png) no-repeat scroll 0 0 / cover;
}
.certificate p {
  font-size: 30px;
  color: #343434;
  margin-bottom: 30px;
  position: relative;
  font-weight: 400;
}
.certificate p::after {
  position: absolute;
  content: "";
  width: 182px;
  height: 1px;
  background: #B9B9B9;
  bottom: -10px;
  left: 37.9%;
}

.certificate p::before {
  position: absolute;
  content: "";
  width: 182px;
  height: 1px;
  background: #B9B9B9;
  bottom: -15px;
  left: 37.9%;
}
.certificate-text p {
	font-family:Arial;
	font-weight: 400;
	font-size: 20px;
	color: #343434;
	margin: 0;
}
.name_of {
	/* font-size: 28px !important; */
	font-family: Tahoma;
	font-weight: 500 !important;
	font-style: italic;
	float: left;
	overflow: hidden;
}
.id_text {
	float: right;
	overflow: hidden;
}
.name {
	font-family: Arial;
	font-weight: 400;
	font-size: 20px;
	color: #343434;
	margin: 0;
	margin-bottom: 5px !important;
	border-bottom: 2px dotted #303188;
    overflow: hidden;
}
 
.text-left{
    text-align: left;
}
.certificate-content h3 {
	font-size: 25px;
	color: #3B3B3B;
	font-family:Arial;
	font-weight: 700;
    margin:0;
}
.certificate-content {
	margin-top: 10px;
}
 
.certificate-content p {
  font-size: 20px;
  color: #101010;
  margin-top: 20px;
}
.footer-area h3 {
  font-family: Arial;
  font-weight: 400;
  font-size: 33px;
  margin-top: 30px;
  color: #3B3B3B;
}
.footer-area p {
	font-family: Arial;
	font-weight: 400;
	font-size: 15px;
	color: #101010;
	margin: 0;
}

.certificate-area {
	/* border: 2px solid #343434; */
	margin-top: 25px;
	/* background: url('assets/images/certificate-bg.png') no-repeat scroll 0 0 / 100% 100%; */
	background-color: #FFF;
	border: 2px dashed #646464;
	outline: 2px dotted #646464;
	padding: 25px;
	box-sizing: border-box;
}
.footer-area {
	overflow: hidden;
	margin-top: 55px;
	margin-bottom: 15px;
}
.c_footer_left p:last-child {
	font-weight: 600;
	font-size: 15px;
}
.s_name {
	font-family: Tahoma !important;
	font-style: italic;
	border-bottom: 1px solid #000;
	width: 70%;
	margin: auto !important;
	margin-bottom: 5px !important;
	padding-bottom: 5px;
}
.c_footer_left {
	float: left;
	width: 50%;
	overflow: hidden;
	display: block;
}
.id_text{

}
.grade_point{
    font-style:italic;
    font-weight: bold;
}

    </style>
</head>
<body>
<div class="certificate-area-outline"> 
                
{{-- {{ $details }} --}}
    <div class="certificate-header">
        <div class="container">
            <div class="certificate-area">
            <div class="certificate-logo">
                <img src="assets/images/logo-eub.png" alt="logo">
            </div>
            <div class="certificate">
            <h1>PROVISIONAL CERTIFICATE</h1>
            {{-- <p>of Excellence</p> --}}
            </div>
            <div class="certificate-text ">
            <p class="name text-left"><span class="name_of">Ashikur Rahman</span> <span class="id_text">ID:#190322042</span></p>
            <p>is declared to have fulfilled te prescribed requirements for the degree of</p>
            </div>
            <div class="certificate-content">
            <h3>Bachelor of Science</h3>
            <h3>In</h3>
            <h3>Computer Science Engineering</h3>
            <p>with a Cumulative Grade Point Average of <span class="grade_point">3.43</span> on a scale of <i><b>4.0</b></i> from the Faculty of Science and Information Technology, <b>European University of Bangladesh.</b></p>
            </div>
            <div class="footer-area">
            <div class="c_footer_left">
                <p class="s_name">Abdul Kalam</p>
                <p>REGISTER</p>
            </div>
            <div class="c_footer_left">
                <p class="s_name">Abdul Samad</p>
                <p>CONTROLLER OF EXAMINATIONS</p>
            </div>
            </div>
        </div>
        </div>
    </div>

</div>

</body>
</html>