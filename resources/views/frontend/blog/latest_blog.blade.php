@extends('layouts.app')
@section('content')
    
<section class="onebox-breadcromb-area breadcromb-bg-image-new">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-box">
                    <ul>
                        <li><a href="{{url(app()->getLocale())}}"><i class="fa fa-home"></i> Home</a></li>
                        <li>/</li>
                        <li>Latest Blog</li>
                    </ul>
                </div>
                <div class="latest-blogs"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="breadcumb-imgg"></div>
            </div>
        </div>
    </div>
</section>


<section class="blog_detail_page">
    <div class="container">
        <div class="blogs_details">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="blog_social">
                        <ul class="blog-footer-social">
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/1boxofficeservices/" class="fb"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/1boxoffice/" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/1boxoffice/" class="inst"><i class="fab fa-instagram"></i></a>
                                </li>
                        </ul>
                    </div>
                    <div class="blog_leagues">
                        <ul>
                            <li><a href=""><span>Premier League</span></a></li>
                            <li><p>04 August, 2022 9:00 </p></li>
                        </ul>
                    </div>

                    <div class="blog_page_details">
                        <h2>Elanga picks his best united goal</h2>

                        <span class="h1_head">Anthony Elanga has picked out the best goal he’s ever scored in a Manchester United shirt.</span>
                        <p>But, perhaps surprisingly, the Sweden international didn’t opt for one of the four first-team goals which have come since his senior debut back in May 2021. The winger netted against Wolves in the final game of the 2020/21 campaign and hit further goals against Brentford, Leeds United and Atletico Madrid last term.</p>

                        <p>Elanga is looking further back for his magnum opus, though, to a United Under-21s game, played behind closed doors in the Papa John’s Trophy back in December 2020.</p>

                        <p>“Ooh. That’s a good question Claire,” Anthony replied, to the original poser from a fan in the UK.</p>

                        <iframe width="100%" height="345" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>

                        <p>“I might have to say when I played against Accrington Stanley in the Papa John’s Trophy. I scored a nice solo goal.</p>

                        <p>“I picked the ball up from my own half and just passed a lot of people, so I think it’s going to have to be that one.”</p>

                        <p>The young Reds ultimately lost that game 3-2 to Stanley, with Facundo Pellistri scoring our other goal.</p>

                        <ul>
                            <li>First important information about the event</li>
                            <li>Second important information </li>
                            <li>Third important information about the event</li>
                        </ul>

                        <p>It was a tough season for Elanga to break into the senior side, although he was one of the outfield players who emerged with most credit in the second half of the campaign. So, what is Anthony’s most memorable moment in a red shirt so far?</p>

                        <p>Although he did claim a prestigious individual prize during his time with the youth sides, he can’t get past the brilliant goal he scored against Atletico Madrid at the Wanda Metropolitano in February.</p>


                        <p>Look out for the full Fans' Q&A with Anthony Elanga coming soon.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="onebox-blog-page-area section_25">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="onebox-section-heading-event">
                    <h2><span>Latest and Greatest</span></h2>
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="single-latest-post">
                    <a href="#"><img src="/public/img/blog/blog1.png" alt="post image"></a>
                    <div class="single-post-text">
                        <h3><a href="#">What’s new for the 2022/23 season?</a></h3>
                        <p>There have been some changes confirmed by the Premier League, ahead of the 2022/23 season.</p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="admin-image">
                                        <ul>
                                            <li><a href="#">04 August, 2022</a></li>
                                            <li><a href="#">19:15</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="admin-image-right">
                                        <a href="#"><i class="fas fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-latest-post">
                    <a href="#"><img src="/public/img/blog/blog2.png" alt="post image"></a>
                    <div class="single-post-text">
                        <h3><a href="#">Match officials for Matchweek 1</a></h3>
                        <p>See who will be officiating in the first round of 2022/23 fixtures, including the Video Assistant Referees</p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="admin-image">
                                        <ul>
                                            <li><a href="#">04 August, 2022</a></li>
                                            <li><a href="#">19:15</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="admin-image-right">
                                        <a href="#"><i class="fas fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-latest-post">
                    <a href="#"><img src="/public/img/blog/blog3.png" alt="post image"></a>
                    <div class="single-post-text">
                        <h3><a href="#">FPL experts' best budget enablers for 2022/23</a></h3>
                        <p>See six cut-price options who can help you afford Salah, Haaland, Kane and more</p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="admin-image">
                                        <ul>
                                            <li><a href="#">04 August, 2022</a></li>
                                            <li><a href="#">19:15</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="admin-image-right">
                                        <a href="#"><i class="fas fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="single-latest-post">
                    <a href="#"><img src="/public/img/blog/blog4.png" alt="post image"></a>
                    <div class="single-post-text">
                        <h3><a href="#">New signings: Adams an ideal fit to replace Phillips</a></h3>
                        <p>There have been some changes confirmed by the Premier League, ahead of the 2022/23 season.</p>
                        <div class="post-text-bottom">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="admin-image">
                                        <ul>
                                            <li><a href="#">04 August, 2022</a></li>
                                            <li><a href="#">19:15</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="admin-image-right">
                                        <a href="#"><i class="fas fa-share-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="upcoming-match-btn-view-all">
                    <a href="" class="onebox-btn">View All News</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script type="text/javascript">

    
</script>
@endpush('scripts')
