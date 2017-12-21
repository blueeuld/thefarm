import * as _ from 'lodash';
import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'dataFilter'
})
export class DataFilterPipe implements PipeTransform {

  transform(array: any[], query: string): any {
    if (query) {
      return _.filter(array, row=>row.name.indexOf(query) > -1);
    }
    return array;
  }
}

@Pipe({
    name: 'dataTableSearchFilter'
})
export class DataTableSearchFilterPipe implements PipeTransform {
    transform(rows: any[], query: string, columnsDef?): any {
        if (query && columnsDef) {
            rows = rows.filter(row => {
                for(let column of columnsDef) {
                    if (column.searchable) {
                        if (row[column.targets].toLowerCase().indexOf(query.trim().toLowerCase()) > -1) {
                            return true;
                        }
                    }
                }
                return false;
            });

        }
        return rows;
    }
}