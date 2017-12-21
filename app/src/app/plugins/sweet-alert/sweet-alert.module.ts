import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

// Sweet Alert
import { SweetAlert2Module } from '@toverux/ngsweetalert2';

import { SweetAlertComponent } from './sweet-alert.component';

// Routing
import { SweetAlertRoutingModule } from './sweet-alert-routing.module';

@NgModule({
  imports: [
    SweetAlertRoutingModule,
    CommonModule,
    SweetAlert2Module.forRoot({
      buttonsStyling: false,
      customClass: 'modal-content',
      confirmButtonClass: 'btn btn-primary',
      cancelButtonClass: 'btn btn-danger'
    })
  ],
  declarations: [
    SweetAlertComponent
  ]
})
export class SweetAlertModule { }
