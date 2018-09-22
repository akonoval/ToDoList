import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Task } from './task';

const CONFIG = {
  apiUrl: 'http://localhost:8080/api/task/'
};

@Injectable()
export class DataService {

    url:string;

    constructor(private http:HttpClient) {
        this.url = CONFIG.apiUrl;
        console.log('this.url', this.url);
    }

    getData() : any {
        return this.http.get(this.url+'read.php');
    };

    createData(task:Task) : any {
        return this.http.post<Task>(this.url+'create.php', task);
    };

    updateData(task:Task) : any {
        return this.http.post<Task>(this.url+'update.php', task);
    };

    deleteData(task:Task) : any {
        return this.http.post<Task>(this.url+'delete.php', task);
    };
}
