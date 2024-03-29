<div class="container-fluid">
  <!-- set for auto play data-ride="carousel" data-interval="8000" add class carousel-fade-->
  <div id="full-width-carousel" class="full-width carousel carousel-fade" data-ride="carousel" data-interval="false">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#full-width-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#full-width-carousel" data-slide-to="1"></li>
      <li data-target="#full-width-carousel" data-slide-to="2"></li>
    </ol>
    <div class="row">
      <!-- Slides -->
      <div class="carousel-inner">
            
        {% for slide in site.data.intro-carousel %}
        <div class="item{% if forloop.first == true %} active{% endif %}">
          {% if "staging" == site.environment %}
          <div class="fill center-block" style="background:url('..{{ site.baseurl }}/{{ slide.image }}') center center;background-size:cover;">
          {% else %}
          <div class="fill center-block" style="background:url('../{{ slide.image }}') center center;background-size:cover;">
          {% endif %}
            <div class="valign">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                  <div class="cw-well">
                    <h2>{{site.tagline}}</h2>
                    {% markdown content/frontpage/intro-section.md %}
                    <p>{{ slide.description }}</p>
                    <a href="#internal-main" class="btn btn-circle page-scroll">
                      <i class="fa fa-chevron-down animated"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {% endfor %}
      </div>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#full-width-carousel" role="button" data-slide="prev">
      <i class="fa fa-chevron-left" aria-hidden="true" style="vertical-align: middle;"></i>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#full-width-carousel" role="button" data-slide="next">
      <span class="fa fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
