@extends('layouts.user')

@section('title', "User Manual")

@section('main_content')
<div class="columns">
  <div class="column is-three-quarters has-border">
    <div class="accordions">
      {{-- joining the forum --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Joining the forum</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <img src="{{asset('images/user_manual/homepage.png')}}" alt="Welcome Page Image">
            <hr>
            <b>
              <ul>
                <li>1. Hit "Join the Discusison" button at the rightmost part of the navbar.</li>
                <li>2. Then the following form will be rendered.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/regis_form.png')}}" alt="Registration form Image">
            <hr>
            <b>
              <ul>
                <li>3. Fill in all the required credentials and press "Join Now".</li>
                <li>4. A confirmation email will be sent to the given e-mail address.</li>
                <li>5. You'll be successfully registered after you've cofirmed the e-mail.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- signing in --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Signing In</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <p class="has-text-weight-bold">- After you've successfully registered, you can now sign in to the forum.</p>
            <hr>
            <img src="{{asset('images/user_manual/homepage1.png')}}" alt="Homepage Image">
            <hr>
            <b>
              <ul>
                <li>1. Hit the "Sign In" button preceding the "Join" button.</li>
                <li>2. The following Sign In form will be rendered.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/signin_form.png')}}" alt="Sign In form Image">
            <hr>
            <b>
              <ul>
                <li>3. Fill in valid credentials and press "Sign In".</li>
                <li>4. You'll be redirected to homepage.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- creating a discussion --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Creating a discussion</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/create_discussion.png')}}" alt="Create Discussion Image">
            <hr>
            <b>
              <ul>
                <li>2. Press "Create Discussion" button situated just below the navigation bar.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/create_discussion_form.png')}}" alt="Create Discussion form Image">
            <hr>
            <b>
              <ul>
                <li>3. Provide all the deatils and press "Publish Discussion".</li>
                <li>4. You'll be redirected to your created discussion.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- updating your discussion --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Updating your discussion</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/click_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison you want to update.</li>
                <li>3. You'll be redirected to that discussion page.</li>
                <li>4. Click on the "pencil" icon just below the published date to see the update form.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/update_discussion_form.png')}}" alt="Update Discussion form Image">
            <hr>
            <b>
              <ul>
                <li>5. Edit the required fields and press "Update Discussion".</li>
                <li>6. You'll be redirected to the updated discussion.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- favorite a discussion --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Favorite a discussion</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison you want to favorite.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite.png')}}" alt="Favoriting discussion Image">
            <hr>
            <b>
              <ul>
                <li>3. Click on the "star" icon just below the published date.</li>
                <li>4. The discussion will be favorited.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- replying to a discussion --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Replying to a discussion</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison you want to reply to.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/reply.png')}}" alt="Replying Image">
            <hr>
            <b>
              <ul>
                <li>3. Type your reply on the textarea and press "Post Your Reply".</li>
                <li>4. You will see your reply underneath the description of the post.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- updating your reply --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Updating your reply</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison where you wish to update the reply.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/edit_reply.png')}}" alt="Editing reply Image">
            <hr>
            <b>
              <ul>
                <li>3. Hover over the reply you wish to update and press the "pencil" icon.</li>
                <li>4. A textarea with the current reply will be displayed.</li>
                <li>5. Edit your reply and hit "Update Your Reply" button.</li>
                <li>6. The updated reply will then be added.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- deleting your reply --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Deleting your reply</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison whose reply you want to delete.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/delete_reply.png')}}" alt="Deleting reply Image">
            <hr>
            <b>
              <ul>
                <li>3. Hover over the reply you want to delete and press the "trash" icon.</li>
                <li>4. The reply will be deleted.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

      {{-- marking best reply --}}
      <article class="accordion">
        <div class="accordion-header toggle">
          <p>Marking best reply</p>
          <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
          <div class="accordion-content">
            <b>
              <ul>
                <li>1. Sign In using valid credentials.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/favorite_link.png')}}" alt="Discussion Link Image">
            <hr>
            <b>
              <ul>
                <li>2. Click on the title of the discusison to open it.</li>
              </ul>
            </b>
            <hr>
            <img src="{{asset('images/user_manual/best_reply.png')}}" alt="Best Reply Image">
            <hr>
            <b>
              <ul>
                <li>3. Click on the "tick" icon of only that reply which you want to mark as best.</li>
                <li>4. That reply will be added at the top of all replies with a "Best Reply" label on it.</li>
              </ul>
            </b>
          </div>
        </div>
      </article>

    </div>
  </div>

  <div class="column">
    @include('partials._filters')
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/utilities/accordion.js')}}"></script>
@endsection
