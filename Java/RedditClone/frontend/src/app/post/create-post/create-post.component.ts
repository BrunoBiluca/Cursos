import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { throwError } from 'rxjs';
import { PostService } from 'src/app/shared/post.service';
import { SubredditModel } from 'src/app/subreddit/subreddit-model';
import { SubredditService } from 'src/app/subreddit/subreddit.service';
import { CreatePostPayload } from './create-post.payload';

@Component({
  selector: 'app-create-post',
  templateUrl: './create-post.component.html',
  styleUrls: ['./create-post.component.scss']
})
export class CreatePostComponent implements OnInit {

  createPostForm!: FormGroup;
  subreddits: SubredditModel[];

  constructor(
    private router: Router,
    private postService: PostService,
    private subredditService: SubredditService
  ) {}

  ngOnInit() {
    this.createPostForm = new FormGroup({
      postName: new FormControl('', Validators.required),
      subredditName: new FormControl('', Validators.required),
      url: new FormControl('', Validators.required),
      description: new FormControl('', Validators.required),
    });

    this.subredditService.getAllSubreddits()
      .subscribe((data) => {
        this.subreddits = data;
      }, error => {
        throwError(error);
      });
  }

  createPost() {
    let postPayload: CreatePostPayload = {
      postName: this.createPostForm.get('postName').value,
      url: this.createPostForm.get('url').value,
      description: this.createPostForm.get('description').value,
      subredditName: this.createPostForm.get('subredditName').value
    }

    this.postService.createPost(postPayload)
      .subscribe((data) => {
        this.router.navigateByUrl('/');
      }, error => {
        throwError(error);
      })
  }

  discardPost() {
    this.router.navigateByUrl('/');
  }

}
