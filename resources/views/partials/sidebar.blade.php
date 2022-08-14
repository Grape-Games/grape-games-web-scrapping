 <div class="dlabnav">
     <div class="dlabnav-scroll">
         <ul class="metismenu" id="menu">
             <li class="dropdown header-profile">
                 <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                     <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name={{ auth()->user()->name }}"
                         width="20" alt="User image" />
                     <div class="header-info ms-3">
                         <span class="font-w600 ">Hi, <b>{{ auth()->user()->name }}</b></span>
                         <small class="text-end font-w400">{{ auth()->user()->email }}</small>
                     </div>
                 </a>
             </li>
             <li>
                 <a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="fa-solid fa-gauge"></i>
                     <span class="nav-text">Dashboard</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.gasoline') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-volcano"></i>
                     <span class="nav-text">Gasoline</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.diesel') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-gas-pump"></i>
                     <span class="nav-text">Diesel</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.lpg') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-capsules"></i>
                     <span class="nav-text">LPG</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.eletricity') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-bolt"></i>
                     <span class="nav-text">Electricity</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.natural-gas') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-smog"></i>
                     <span class="nav-text">Natural Gas</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.kerosine-oil') }}" class="ai-icon" aria-expanded="false">
                    <i class="fa-solid fa-oil-can"></i>
                     <span class="nav-text">Kerosene Oil</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('prices.heating-oil') }}" class="ai-icon" aria-expanded="false">
                    <i class="fa-solid fa-oil-well"></i>
                     <span class="nav-text">Heating Oil</span>
                 </a>
             </li>
             <li>
                 <a href="{{ route('currency-rates.index') }}" class="ai-icon" aria-expanded="false">
                     <i class="fa-solid fa-money-bill-trend-up"></i>
                     <span class="nav-text">Exchange Rates</span>
                 </a>
             </li>
             <li>
                 <a href="#" class="ai-icon" aria-expanded="false">
                     <i class="fa fa-book" aria-hidden="true"></i>
                     <span class="nav-text">API Documentation</span>
                 </a>
             </li>
         </ul>
         <div class="copyright">
             <p><strong>Fuels Prices and Currency Exchange</strong> © {{ date('Y') }} All Rights Reserved</p>
             <p class="fs-12">Made with <span class="heart"></span> by Fast Devs</p>
         </div>
     </div>
 </div>
