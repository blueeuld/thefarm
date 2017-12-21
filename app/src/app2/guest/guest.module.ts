import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

// DataTable
import { DataTableModule } from 'angular2-datatable';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';

//Routing
import {GuestComponent} from "./guest.component";
import {GuestRoutingModule} from "./guest-routing.module";

//
@NgModule({
    imports: [
        GuestRoutingModule,
        CommonModule,
        DataTableModule,
        FormsModule,
        HttpModule
    ],
    declarations: [
        GuestComponent
    ]
})
export class GuestModule { }
