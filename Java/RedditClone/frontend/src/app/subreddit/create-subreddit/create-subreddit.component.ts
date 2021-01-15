import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { SubredditModel } from '../subreddit-model';
import { SubredditService } from '../subreddit.service';

@Component({
  selector: 'app-create-subreddit',
  templateUrl: './create-subreddit.component.html',
  styleUrls: ['./create-subreddit.component.scss']
})
export class CreateSubredditComponent implements OnInit {

  createSubredditForm!: FormGroup;
  title = new FormControl('');
  description = new FormControl('');

  constructor(private router: Router, private subredditService: SubredditService) {
  }

  ngOnInit() {
    this.createSubredditForm = new FormGroup({
      title: new FormControl('', Validators.required),
      description: new FormControl('', Validators.required)
    });

  }

  discard() {
    this.router.navigateByUrl('/');
  }

  createSubreddit() {
    let subredditModel: SubredditModel = {
      name: this.createSubredditForm.get('title').value,
      description: this.createSubredditForm.get('description').value
    }

    this.subredditService.createSubreddit(subredditModel)
      .subscribe(data => {
        this.router.navigateByUrl('/list-subreddits');
      }, error => {
        console.log('Error occurred');
      })
  }
}
