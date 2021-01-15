import { Component, OnInit } from '@angular/core';
import { throwError } from 'rxjs';
import { SubredditModel } from '../subreddit-model';
import { SubredditService } from '../subreddit.service';

@Component({
  selector: 'app-list-subreddits',
  templateUrl: './list-subreddits.component.html',
  styleUrls: ['./list-subreddits.component.scss']
})
export class ListSubredditsComponent implements OnInit {

  subreddits: SubredditModel[] = [];
  constructor(private subredditService: SubredditService) { }

  ngOnInit() {
    this.subredditService.getAllSubreddits()
      .subscribe(data => {
        this.subreddits = data;
      }, error => {
        throwError(error);
      })
  }

}
