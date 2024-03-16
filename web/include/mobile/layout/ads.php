<div class="main-view">
  <div class="user-view">
    <div class="search-box">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" placeholder="Tìm kiếm trong rao vặt..." autocomplete="off">
    </div>
  </div>
  <div class="banner">
    <div id="ADSslider" class="keen-slider">
      <div class="keen-slider__slide sliderH">1</div>
      <div class="keen-slider__slide sliderH">2</div>
      <div class="keen-slider__slide sliderH">3</div>
      <div class="keen-slider__slide sliderH">4</div>
      <div class="keen-slider__slide sliderH">5</div>
      <div class="keen-slider__slide sliderH">6</div>
    </div>
  </div>
  <div class="main-content">
    <div class="flex filter-b-head mg0x5">
      <div class="flex left">
      </div>
      <div class="flex right g5">
        <select>
          <option>Khu vực</option>
        </select>
        <select>
          <option>Danh mục</option>
        </select>
        <select>
          <option>Phân loại</option>
        </select>
      </div>
    </div>
    <div class="flex-c main-b">
      <div class="flex sb gap5">
        <div class="list2">
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="flex g5" style="align-items: baseline;">
                <div class="h1">Ngô luộc <time-r>8:00-20:00</time-r></div>
                <div class="seal-target">Đã bán 0/10</div>
              </div>
              <div class="cost">10.000</div>
              <div class="h2">Quán bà Huyền</div>
              <div class="address"><i class="fa-solid fa-location-dot"></i> Địa chỉ: <a href="#">Cách 100m NVH thôn Ngũ Hồ ||</a></div>
            </div>
          </div>
          <div class="bookmark-item-t">
            <div class="bookmark-item-logo">
              <img src="#">
            </div>
            <div class="bookmark-item-details">
              <div class="h1">Mì xào</div>
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
  var ADSslider = new KeenSlider(
    "#ADSslider",{
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