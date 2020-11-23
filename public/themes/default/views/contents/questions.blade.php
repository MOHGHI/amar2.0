<div class="row">
    <div class="col-md-12">
        @auth('customer')
        {!! Form::open(['route' => ['ask.question'], 'id' => 'questionform', 'novalidate']) !!}
            <input name="product_id" type="hidden" value="{{$item->product_id}}">
            <input name="shop_id" type="hidden" value="{{$item->shop_id}}">
            <input name="customer_id" type="hidden" value="{{$item->product_id}}">
            <input name="slug" type="hidden" value="{{$item->slug}}">
            <div class="form-group">
                <label for="question">Ask a question from seller.</label>
                <textarea class="form-control flat" rows="2" placeholder="Write your message within 500 characters" required=""
                    name="message" cols="50" id="question"></textarea>
                <div class="help-block with-errors"></div>
                <div class="form-group pull-right">
                    <div class="space10"></div>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary btn-lg pull-right flat"><i
                            class="fa fa-paper-plane"></i> Send Message</button>
                </div>
            </div>
        {!! Form::close() !!}

        @else
        <button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-sm flat pull-right " id="checkout-btn" ><i class="fa fa-shopping-cart"></i> Login to Ask Question</button>
        @endauth
    </div>
    <div class="col-md-12">
        <div class="questions-wrapper">
            <h5 class="qna-section-title">Other questions answered by 
                <a href="{{ route('show.store', $item->shop->slug) }}" class="seller-info-name">
                    {!! $item->shop->getQualifiedName() !!}
                </a>
            </h5>
            <ul class="qna-list" data-spm="qa">
                <li class="qna-item">
                    @foreach($questions as $question)
                        <div class="qna-item-group">
                            <div class="row">
                                <div class="col-md-1 nopadding qna-label">
                                    <span class="question">Q</span>
                                </div>
                                <div class="col-md-11">
                                    <div class="qna-content">{{$question->message}}</div>
                                    <div class="qna-meta">{{-- $question->customer->getName() --}}</div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-md-1 nopadding qna-label">
                                    <span class="answer">A</span>
                                </div>
                                <div class="col-md-11">
                                    <div class="qna-content">Not Answered Yet</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
</div>