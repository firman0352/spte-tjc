import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// function data() {
//     function getIsMinimizeSidebarFromLocalStorage() {
//         if (window.localStorage.getItem("minimizeSidebar")) {
//           return JSON.parse(window.localStorage.getItem("minimizeSidebar"));
//         }
    
//         return false;
//       }
    
//     function setIsMinimizeSidebarToLocalStorage(value) {
//         window.localStorage.setItem("minimizeSidebar", value);
//       }
//       return {  
    
//         isMinimizeSidebar: getIsMinimizeSidebarFromLocalStorage(),
//         toggleMinimizeSidebar() {
//           this.isMinimizeSidebar = !this.isMinimizeSidebar;
//           setIsMinimizeSidebarToLocalStorage(this.isMinimizeSidebar);
//         },
//         };
//     }