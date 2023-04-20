'use strict';

import Toggle from "./classes/toggle";
import Tab from "./classes/tab";
// import AnimatedCounter from "./classes/animated-counter";
import GiftSearch from "./classes/gift-search";
import Common from "./classes/common";
import './modules/steps';
import './modules/checkout';
import './modules/thank-you';
import './modules/magic-gift';
import './modules/lang-switcher';
import './modules/input-flags';
import './modules/change_svg';
import createCustomDropdowns from "./modules/dropdown";
import wishList from "./modules/wishlist";
import accountTab from "./modules/account-menu";
import './modules/ajax';
import './modules/row-switcher';
import modal from './classes/modal.js';


import { Fancybox, Carousel, Panzoom } from "@fancyapps/ui";


jQuery(document).ready(($) => {


  runMainScripts();



  function runMainScripts(e = null) {
    new Toggle(e);

    new modal('.c-modal', '.l-modal-container');

      if (window.isLoginError || (themeVars.isProduct && themeVars.userID == '0')) {
          setTimeout(() => document.querySelectorAll('.site-login.function-toggle').forEach(item => item.click()), 500);
      }

    new Tab(e);
    // new AnimatedCounter(e);
    new GiftSearch(e);
    new Common(e);


    createCustomDropdowns();

    wishList();
    accountTab();


  }
});

