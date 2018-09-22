import { Pipe, PipeTransform } from '@angular/core';
import { includes } from 'lodash';

@Pipe({
    name: 'filter'
})
export class FilterPipe implements PipeTransform {
    transform(items: any[], searchText: string): any[] {
        if(!items) return [];
        if(!searchText) return items;

        searchText = searchText.toLowerCase();

        return items.filter( it => {
            return includes(it.name, searchText);
        });
   }
}