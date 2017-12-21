import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { ButtonsComponent } from './buttons.component';
import { CardsComponent } from './cards.component';
import { GridComponent } from './grid.component';
import { TypographyComponent } from './typography.component';

// Forms Component
import { FormsComponent } from './forms.component';
import { BsDropdownModule } from 'ngx-bootstrap/dropdown';

import { SocialButtonsComponent } from './social-buttons.component';
import { SwitchesComponent } from './switches.component';
import { TablesComponent } from './tables.component';

// Sortable Component
import { SortableModule } from 'ngx-bootstrap';
import { SortComponent } from './sort.component';

import { TreeModule } from 'angular-tree-component';
import { TreeDragDropComponent } from './tree-drag-drop.component';

// Modal Component
import { ModalModule } from 'ngx-bootstrap/modal';
import { ModalsComponent } from './modals.component';

// Tabs Component
import { TabsModule } from 'ngx-bootstrap/tabs';
import { TabsComponent } from './tabs.component';

// Components Routing
import { ComponentsRoutingModule } from './components-routing.module';

@NgModule({
  imports: [
    FormsModule,
    CommonModule,
    ComponentsRoutingModule,
    BsDropdownModule.forRoot(),
    ModalModule.forRoot(),
    TabsModule,
    SortableModule.forRoot(),
    TreeModule
  ],
  declarations: [
    ButtonsComponent,
    CardsComponent,
    GridComponent,
    TypographyComponent,
    FormsComponent,
    ModalsComponent,
    SocialButtonsComponent,
    SwitchesComponent,
    SortComponent,
    TablesComponent,
    TabsComponent,
    TreeDragDropComponent
  ]
})
export class ComponentsModule { }
