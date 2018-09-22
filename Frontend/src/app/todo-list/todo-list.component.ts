import { Component, OnInit } from '@angular/core';
import { DataService } from '../data.service'
import { Task } from '../task';
import { FilterPipe } from '../filter.pipe';


@Component({
  selector: 'app-todo-list',
  templateUrl: './todo-list.component.html',
  styleUrls: ['./todo-list.component.css']
})

export class TodoListComponent implements OnInit {
    public listData:Task[];
    public showCompleated:boolean;
    public createMode:boolean;
    public searchText:string;

    constructor(private dataService:DataService) {
        this.showCompleated = true;
        this.createMode = false;
    }


    ngOnInit() {
        this.dataService.getData().subscribe((responce:any) => {
            if (!responce.data) this.listData = [];

            this.listData = responce.data;
        });
    }

    changeMode(){
        this.createMode = !this.createMode;
    }

    changeView(){
        this.showCompleated = !this.showCompleated;
    }

    public addTask(taskName:string) {
        let task:Task = {
            name: taskName
        };
        this.dataService.createData(task).subscribe(
            res=>{
                if (res.id) {
                    task.id = res.id;
                    if (this.listData) {
                        this.listData.unshift(task);
                    }
                    else {
                        this.listData=[task];
                    }
                }
                this.createMode = false;
            },
            res=> {
                console.log('Error:', res.error)
            }
        );
    }

    public changeStatus(task:Task) {
        task.deleted = !task.deleted;
        this.dataService.updateData(task).subscribe();
    }

    public deleteTask(task:Task, listId) {
        this.dataService.deleteData(task).subscribe(res=>{
            this.listData.splice(listId, 1);
        });
    }
}
