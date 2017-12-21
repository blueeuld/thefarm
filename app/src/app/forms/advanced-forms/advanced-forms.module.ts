import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

// Angular 2 Input Mask
import { TextMaskModule } from 'angular2-text-mask';

// Timepicker
import { TimepickerModule } from 'ngx-bootstrap/timepicker';

// Bootstrap Datepicker - Inbuilt
import { BsDatepickerModule } from 'ngx-bootstrap/datepicker';

// Other daterange picker module
import { Daterangepicker } from 'ng2-daterangepicker';

// Ng2-select
import { SelectModule } from 'ng2-select';

//Routing
import { AdvancedFormsRoutingModule } from './advanced-forms-routing.module';

import { AdvancedFormsComponent } from './advanced-forms.component';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    AdvancedFormsRoutingModule,
    TextMaskModule,
    TimepickerModule.forRoot(),
    BsDatepickerModule.forRoot(),
    SelectModule,
    Daterangepicker
  ],
  declarations: [
    AdvancedFormsComponent
  ]
})
export class AdvancedFormsModule { }
