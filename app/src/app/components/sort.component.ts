import { Component, ViewChild  } from '@angular/core';
import {SortableComponent} from 'ngx-bootstrap';

@Component({
  templateUrl: 'sort.component.html'
})
export class SortComponent {

  @ViewChild(SortableComponent) sortableComponent: SortableComponent;

  public itemStringsLeft1: any[] = [
    'Windstorm',
    'Bombasto',
    'Magneta',
    'Tornado'
  ];

  public itemStringsRight1: any[] = [
    'Mr. O',
    'Tomato'
  ];

  constructor() { }


  onCrossClick( index: number ) {
    const column = this.itemStringsLeft1.splice(index, 1)[0];
    this.itemStringsRight1.push( column );
    this.sortableComponent.writeValue(this.itemStringsLeft1);
  }


  onDropChange(  index: number  ) {
    const column = this.itemStringsRight1.splice((index - 1), 1)[0]; // (index - 1) => selected index is adding -add column- option as well
    this.itemStringsLeft1.push( column );
    this.sortableComponent.writeValue(this.itemStringsLeft1);
  }

}
