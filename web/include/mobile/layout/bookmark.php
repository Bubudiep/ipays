<div class="main-view">
  <div class="user-view">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Tìm kiếm trong đã lưu..." autocomplete="off">
    </div>
  </div>
  <div class="banner">
    <div id="BOOKslider" class="keen-slider">
      <div class="keen-slider__slide sliderH">1</div>
      <div class="keen-slider__slide sliderH">2</div>
      <div class="keen-slider__slide sliderH">3</div>
      <div class="keen-slider__slide sliderH">4</div>
      <div class="keen-slider__slide sliderH">5</div>
      <div class="keen-slider__slide sliderH">6</div>
    </div>
  </div>
  <div class="main-content">
    <div class="flex-c main-b">
      <div class="flex main-b-head">
        <div class="flex left">
          <div class="m-h1">Đang theo dõi</div>
        </div>
        <div class="flex right"><a href="#">Tất cả <i class="fa-solid fa-angle-right"></i></a></div>
      </div>
      <div class="flex sb gap5">
        <div class="list">
          <div class="follow-item-t">
            <div class="follow-item-logo"><img src="#"></div>
            <div class="follow-item-details">
              <div class="u1">Hùng đẹp trai</div>
              <div class="h5">Offline cách đây 20 phút</div>
            </div>
          </div>
        </div>
      </div>
      <div class="flex main-b-head">
        <div class="flex left">
          <div class="m-h1">Sản phẩm đã lưu</div>
        </div>
        <div class="flex right"><a href="#">Tất cả <i class="fa-solid fa-angle-right"></i></a></div>
      </div>
      <div class="flex sb gap5">
        <div class="list flex-c f1">
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Món ăn A</div>
              <div class="cost">20.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Món ăn A</div>
              <div class="cost">20.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Món ăn A</div>
              <div class="cost">20.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Món ăn A</div>
              <div class="cost">20.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Món ăn A</div>
              <div class="cost">20.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(async()=>{
  // slider
  var BOOKslider = new KeenSlider(
    "#BOOKslider",{
      loop: true,
    },[(slider) => {
        let timeout
        let mouseOver = false
        function clearNextTimeout() {
          clearTimeout(timeout)
        }
        function nextTimeout() {
          clearTimeout(timeout)
          if (mouseOver) return
          timeout = setTimeout(() => {
            slider.next()
          }, 2000)
        }
        slider.on("created", () => {
          slider.container.addEventListener("mouseover", () => {
            mouseOver = true
            clearNextTimeout()
          })
          slider.container.addEventListener("mouseout", () => {
            mouseOver = false
            nextTimeout()
          })
          nextTimeout()
        })
        slider.on("dragStarted", clearNextTimeout)
        slider.on("animationEnded", nextTimeout)
        slider.on("updated", nextTimeout)
      },
    ]
  )
});
</script>