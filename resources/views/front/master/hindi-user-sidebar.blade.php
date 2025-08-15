<div class="col-md-4 col-lg-3">
            <div class="loansecond-cont mt-0 usermenu aos-init aos-animate" data-aos="fade-left">
             <h5>उपयोगकर्ता विकल्प सूची</h5>
             <ul class="docreq-list">
                  <li><a href="{{ route('user-dashboard') }}"><i class="fas fa-check-square"></i> डैशबोर्ड </a></li>
                  <!-- <li><a href="#"><i class="fas fa-check-square"></i> Change Password </a></li> -->
               <li><a href="{{ route('my-profile') }}"><i class="fas fa-check-square"></i> प्रोफाइल </a></li>

                  <li><a href="{{ route('loan-details') }}"><i class="fas fa-check-square"></i> ऋण विवरण </a>
                        </li>
                        <li><a href="{{ url('emi') }}"><i class="fas fa-check-square"></i>मेरी देय किश्त </a></li>
                        <li><a href="{{ route('transaction-history') }}"><i class="fas fa-check-square"></i> हिस्ट्री
                            </a></li>
                  <li><a href="{{ url('customerLogout') }}"><i class="fas fa-check-square"></i> लॉग आउट </a></li>
             </ul>

          </div>

          
        </div>