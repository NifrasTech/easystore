@extends('layouts/contentLayoutMaster')

@section('title', 'Tabs')

@section('content')
<!-- Basic tabs start -->
<section id="basic-tabs-components">
  <div class="row match-height">
    <!-- Basic Tabs starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Basic Tab</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="home-tab"
                data-bs-toggle="tab"
                href="#home"
                aria-controls="home"
                role="tab"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profile-tab"
                data-bs-toggle="tab"
                href="#profile"
                aria-controls="profile"
                role="tab"
                aria-selected="false"
                >Service</a
              >
            </li>
            <li class="nav-item">
              <a href="disabled" id="disabled-tab" class="nav-link disabled">Disabled</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="about-tab"
                data-bs-toggle="tab"
                href="#about"
                aria-controls="about"
                role="tab"
                aria-selected="false"
                >Account</a
              >
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
              <p>
                Candy canes donut chupa chups candy canes lemon drops oat cake wafer. Cotton candy candy canes marzipan
                carrot cake. Sesame snaps lemon drops candy marzipan donut brownie tootsie roll. Icing croissant bonbon
                biscuit gummi bears. Pudding candy canes sugar plum cookie chocolate cake powder croissant.
              </p>
              <p>
                Carrot cake tiramisu danish candy cake muffin croissant tart dessert. Tiramisu caramels candy canes
                chocolate cake sweet roll liquorice icing cupcake. Candy cookie sweet roll bear claw sweet roll.
              </p>
            </div>
            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
              <p>
                Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
                Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
                brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
              </p>
              <p>
                Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
                danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
              </p>
            </div>
            <div class="tab-pane" id="disabled" aria-labelledby="disabled-tab" role="tabpanel">
              <p>
                Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar biscuit
                tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet bear claw.
              </p>
            </div>
            <div class="tab-pane fade " id="about" aria-labelledby="about-tab" role="tabpanel">
              <p>
                Gingerbread cake cheesecake lollipop topping bonbon chocolate sesame snaps. Dessert macaroon bonbon
                carrot cake biscuit. Lollipop lemon drops cake gingerbread liquorice. Sweet gummies dragée. Donut bear
                claw pie halvah oat cake cotton candy sweet roll. Cotton candy sweet roll donut ice cream.
              </p>
              <p>
                Halvah bonbon topping halvah ice cream cake candy. Wafer gummi bears chocolate cake topping powder.
                Sweet marzipan cheesecake jelly-o powder wafer lemon drops lollipop cotton candy.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Basic Tabs ends -->

    <!-- Tabs with Icon starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tab with icon</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="homeIcon-tab"
                data-bs-toggle="tab"
                href="#homeIcon"
                aria-controls="home"
                role="tab"
                aria-selected="true"
                ><i data-feather="home"></i> Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profileIcon-tab"
                data-bs-toggle="tab"
                href="#profileIcon"
                aria-controls="profile"
                role="tab"
                aria-selected="false"
                ><i data-feather="tool"></i> Service</a
              >
            </li>
            <li class="nav-item">
              <a href="disabledIcon" id="disabledIcon-tab" class="nav-link disabled"
                ><i data-feather="eye-off"></i> Disabled</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="aboutIcon-tab"
                data-bs-toggle="tab"
                href="#aboutIcon"
                aria-controls="about"
                role="tab"
                aria-selected="false"
                ><i data-feather="user"></i> Account</a
              >
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
              <p>
                Candy canes donut chupa chups candy canes lemon drops oat cake wafer. Cotton candy candy canes marzipan
                carrot cake. Sesame snaps lemon drops candy marzipan donut brownie tootsie roll. Icing croissant bonbon
                biscuit gummi bears. Pudding candy canes sugar plum cookie chocolate cake powder croissant.
              </p>
              <p>
                Carrot cake tiramisu danish candy cake muffin croissant tart dessert. Tiramisu caramels candy canes
                chocolate cake sweet roll liquorice icing cupcake. Candy cookie sweet roll bear claw sweet roll.
              </p>
            </div>
            <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
              <p>
                Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
                Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
                brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
              </p>
              <p>
                Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
                danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
              </p>
            </div>
            <div class="tab-pane" id="disabledIcon" aria-labelledby="disabledIcon-tab" role="tabpanel">
              <p>
                Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar biscuit
                tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet bear claw.
              </p>
            </div>
            <div class="tab-pane" id="aboutIcon" aria-labelledby="aboutIcon-tab" role="tabpanel">
              <p>
                Gingerbread cake cheesecake lollipop topping bonbon chocolate sesame snaps. Dessert macaroon bonbon
                carrot cake biscuit. Lollipop lemon drops cake gingerbread liquorice. Sweet gummies dragée. Donut bear
                claw pie halvah oat cake cotton candy sweet roll. Cotton candy sweet roll donut ice cream.
              </p>
              <p>
                Halvah bonbon topping halvah ice cream cake candy. Wafer gummi bears chocolate cake topping powder.
                Sweet marzipan cheesecake jelly-o powder wafer lemon drops lollipop cotton candy.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Tabs with Icon ends -->
  </div>
</section>
<!-- Basic Tabs end -->

<!-- Vertical Tabs start -->
<section id="vertical-tabs">
  <div class="row match-height">
    <!-- Vertical Left Tabs start -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vertical Left Tabs</h4>
        </div>
        <div class="card-body">
          <div class="nav-vertical">
            <ul class="nav nav-tabs nav-left flex-column" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="baseVerticalLeft-tab1"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalLeft1"
                  href="#tabVerticalLeft1"
                  role="tab"
                  aria-selected="true"
                  >Tab 1</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="baseVerticalLeft-tab2"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalLeft2"
                  href="#tabVerticalLeft2"
                  role="tab"
                  aria-selected="false"
                  >Tab 2</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="baseVerticalLeft-tab3"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalLeft3"
                  href="#tabVerticalLeft3"
                  role="tab"
                  aria-selected="false"
                  >Tab 3
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div
                class="tab-pane active"
                id="tabVerticalLeft1"
                role="tabpanel"
                aria-labelledby="baseVerticalLeft-tab1"
              >
                <p>
                  Oat cake marzipan cake lollipop caramels wafer pie jelly beans. Icing halvah chocolate cake carrot
                  cake. Jelly beans carrot cake marshmallow gingerbread chocolate cake. Sweet fruitcake cheesecake
                  biscuit cotton candy. Cookie powder marshmallow donut. Gummies cupcake croissant.
                </p>
              </div>
              <div class="tab-pane" id="tabVerticalLeft2" role="tabpanel" aria-labelledby="baseVerticalLeft-tab2">
                <p>
                  Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy oat cake fruitcake
                  jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie powder marshmallow donut.
                  Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
                </p>
              </div>
              <div class="tab-pane" id="tabVerticalLeft3" role="tabpanel" aria-labelledby="baseVerticalLeft-tab3">
                <p>
                  Icing croissant powder jelly bonbon cake marzipan fruitcake. Tootsie roll marzipan tart marshmallow
                  pastry cupcake chupa chups cookie. Fruitcake dessert lollipop pudding jelly. Cookie dragée jujubes
                  croissant lemon drops cotton candy. Carrot cake candy canes powder donut toffee cookie.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Vertical Left Tabs ends -->

    <!-- Vertical Right Tabs start -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Vertical Right Tabs</h4>
        </div>
        <div class="card-body">
          <div class="nav-vertical">
            <ul class="nav nav-tabs nav-right flex-column" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="baseVerticalRight-tab1"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalRight1"
                  href="#tabVerticalRight1"
                  role="tab"
                  aria-selected="true"
                  >Tab 1</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="baseVerticalRight-tab2"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalRight2"
                  href="#tabVerticalRight2"
                  role="tab"
                  aria-selected="false"
                  >Tab 2</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="baseVerticalRight-tab3"
                  data-bs-toggle="tab"
                  aria-controls="tabVerticalRight3"
                  href="#tabVerticalRight3"
                  role="tab"
                  aria-selected="false"
                  >Tab 3
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div
                class="tab-pane active"
                id="tabVerticalRight1"
                role="tabpanel"
                aria-labelledby="baseVerticalRight-tab1"
              >
                <p>
                  Oat cake marzipan cake lollipop caramels wafer pie jelly beans. Icing halvah chocolate cake carrot
                  cake. Jelly beans carrot cake marshmallow gingerbread chocolate cake. Sweet fruitcake cheesecake
                  biscuit cotton candy. Cookie powder marshmallow donut. Gummies cupcake croissant.
                </p>
              </div>
              <div class="tab-pane" id="tabVerticalRight2" role="tabpanel" aria-labelledby="baseVerticalRight-tab2">
                <p>
                  Sugar plum tootsie roll biscuit caramels. Liquorice brownie pastry cotton candy oat cake fruitcake
                  jelly chupa chups. Sweet fruitcake cheesecake biscuit cotton candy. Cookie powder marshmallow donut.
                  Pudding caramels pastry powder cake soufflé wafer caramels. Jelly-o pie cupcake.
                </p>
              </div>
              <div class="tab-pane" id="tabVerticalRight3" role="tabpanel" aria-labelledby="baseVerticalRight-tab3">
                <p>
                  Icing croissant powder jelly bonbon cake marzipan fruitcake. Tootsie roll marzipan tart marshmallow
                  pastry cupcake chupa chups cookie. Fruitcake dessert lollipop pudding jelly. Cookie dragée jujubes
                  croissant lemon drops cotton candy. Carrot cake candy canes powder donut toffee cookie.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Vertical Right Tabs ends -->
  </div>
</section>
<!-- Vertical Tabs end -->

<section id="nav-filled">
  <div class="row match-height">
    <!-- Filled Tabs starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Filled</h4>
        </div>
        <div class="card-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="home-tab-fill"
                data-bs-toggle="tab"
                href="#home-fill"
                role="tab"
                aria-controls="home-fill"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profile-tab-fill"
                data-bs-toggle="tab"
                href="#profile-fill"
                role="tab"
                aria-controls="profile-fill"
                aria-selected="false"
                >Profile</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="messages-tab-fill"
                data-bs-toggle="tab"
                href="#messages-fill"
                role="tab"
                aria-controls="messages-fill"
                aria-selected="false"
                >Messages</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="settings-tab-fill"
                data-bs-toggle="tab"
                href="#settings-fill"
                role="tab"
                aria-controls="settings-fill"
                aria-selected="false"
                >Settings</a
              >
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
              <p>
                Chocolate cake sweet roll lemon drops marzipan chocolate cake cupcake cotton candy. Dragée ice cream
                dragée biscuit chupa chups bear claw cupcake brownie cotton candy. Sesame snaps topping cupcake cake.
                Macaroon lemon drops gummies danish marzipan donut.
              </p>
              <p>
                Chocolate bar soufflé tiramisu tiramisu jelly-o carrot cake gummi bears cake. Candy canes wafer
                croissant donut bonbon dragée bear claw jelly sugar plum. Sweet lemon drops caramels croissant
                cheesecake jujubes carrot cake fruitcake. Halvah biscuit lemon drops fruitcake tart.
              </p>
            </div>
            <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
              <p>
                Bear claw jelly beans wafer pastry jelly beans candy macaroon biscuit topping. Sesame snaps lemon drops
                donut gingerbread dessert cotton candy wafer croissant jelly beans. Sweet roll halvah gingerbread bonbon
                apple pie gummies chocolate bar pastry gummi bears.
              </p>
              <p>
                Croissant danish chocolate bar pie muffin. Gummi bears marshmallow chocolate bar bear claw. Fruitcake
                halvah chupa chups dragée carrot cake cookie. Carrot cake oat cake cake chocolate bar cheesecake. Wafer
                gingerbread sweet roll candy chocolate bar gingerbread.
              </p>
            </div>
            <div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
              <p>
                Croissant jelly tootsie roll candy canes. Donut sugar plum jujubes sweet roll chocolate cake wafer. Tart
                caramels jujubes. Dragée tart oat cake. Fruitcake cheesecake danish. Danish topping candy jujubes. Candy
                canes candy canes lemon drops caramels tiramisu chocolate bar pie.
              </p>
              <p>
                Gummi bears tootsie roll cake wafer. Gummies powder apple pie bear claw. Caramels bear claw fruitcake
                topping lemon drops. Carrot cake macaroon ice cream liquorice donut soufflé. Gummi bears carrot cake
                toffee bonbon gingerbread lemon drops chocolate cake.
              </p>
            </div>
            <div class="tab-pane" id="settings-fill" role="tabpanel" aria-labelledby="settings-tab-fill">
              <p>
                Candy canes halvah biscuit muffin dessert biscuit marzipan. Gummi bears marzipan bonbon chupa chups
                biscuit lollipop topping. Muffin sweet apple pie sweet roll jujubes chocolate. Topping cake chupa chups
                chocolate bar tiramisu tart sweet roll chocolate cake.
              </p>
              <p>
                Jelly beans caramels muffin wafer sesame snaps chupa chups chocolate cake pastry halvah. Sugar plum
                cotton candy macaroon tootsie roll topping. Liquorice topping chocolate cake tart tootsie roll danish
                bear claw. Donut candy canes marshmallow. Wafer cookie apple pie.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Filled Tabs ends -->

    <!-- Justified Tabs starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Justified</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link active"
                id="home-tab-justified"
                data-bs-toggle="tab"
                href="#home-just"
                role="tab"
                aria-controls="home-just"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="profile-tab-justified"
                data-bs-toggle="tab"
                href="#profile-just"
                role="tab"
                aria-controls="profile-just"
                aria-selected="true"
                >Profile</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="messages-tab-justified"
                data-bs-toggle="tab"
                href="#messages-just"
                role="tab"
                aria-controls="messages-just"
                aria-selected="false"
                >Messages</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="settings-tab-justified"
                data-bs-toggle="tab"
                href="#settings-just"
                role="tab"
                aria-controls="settings-just"
                aria-selected="false"
                >Settings</a
              >
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content pt-1">
            <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
              <p>
                Chocolate cake sweet roll lemon drops marzipan chocolate cake cupcake cotton candy. Dragée ice cream
                dragée biscuit chupa chups bear claw cupcake brownie cotton candy. Sesame snaps topping cupcake cake.
                Macaroon lemon drops gummies danish marzipan donut.
              </p>
              <p>
                Chocolate bar soufflé tiramisu tiramisu jelly-o carrot cake gummi bears cake. Candy canes wafer
                croissant donut bonbon dragée bear claw jelly sugar plum. Sweet lemon drops caramels croissant
                cheesecake jujubes carrot cake fruitcake. Halvah biscuit lemon drops fruitcake tart.
              </p>
            </div>
            <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
              <p>
                Bear claw jelly beans wafer pastry jelly beans candy macaroon biscuit topping. Sesame snaps lemon drops
                donut gingerbread dessert cotton candy wafer croissant jelly beans. Sweet roll halvah gingerbread bonbon
                apple pie gummies chocolate bar pastry gummi bears.
              </p>
              <p>
                Croissant danish chocolate bar pie muffin. Gummi bears marshmallow chocolate bar bear claw. Fruitcake
                halvah chupa chups dragée carrot cake cookie. Carrot cake oat cake cake chocolate bar cheesecake. Wafer
                gingerbread sweet roll candy chocolate bar gingerbread.
              </p>
            </div>
            <div class="tab-pane" id="messages-just" role="tabpanel" aria-labelledby="messages-tab-justified">
              <p>
                Croissant jelly tootsie roll candy canes. Donut sugar plum jujubes sweet roll chocolate cake wafer. Tart
                caramels jujubes. Dragée tart oat cake. Fruitcake cheesecake danish. Danish topping candy jujubes. Candy
                canes candy canes lemon drops caramels tiramisu chocolate bar pie.
              </p>
              <p>
                Gummi bears tootsie roll cake wafer. Gummies powder apple pie bear claw. Caramels bear claw fruitcake
                topping lemon drops. Carrot cake macaroon ice cream liquorice donut soufflé. Gummi bears carrot cake
                toffee bonbon gingerbread lemon drops chocolate cake.
              </p>
            </div>
            <div class="tab-pane" id="settings-just" role="tabpanel" aria-labelledby="settings-tab-justified">
              <p>
                Candy canes halvah biscuit muffin dessert biscuit marzipan. Gummi bears marzipan bonbon chupa chups
                biscuit lollipop topping. Muffin sweet apple pie sweet roll jujubes chocolate. Topping cake chupa chups
                chocolate bar tiramisu tart sweet roll chocolate cake.
              </p>
              <p>
                Jelly beans caramels muffin wafer sesame snaps chupa chups chocolate cake pastry halvah. Sugar plum
                cotton candy macaroon tootsie roll topping. Liquorice topping chocolate cake tart tootsie roll danish
                bear claw. Donut candy canes marshmallow. Wafer cookie apple pie.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Justified Tabs ends -->
  </div>
</section>

<section id="nav-tabs-aligned">
  <div class="row match-height">
    <!-- Centered Aligned Tabs starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Center</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link"
                id="home-tab-center"
                data-bs-toggle="tab"
                href="#home-center"
                aria-controls="home-center"
                role="tab"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link active"
                id="service-tab-center"
                data-bs-toggle="tab"
                href="#service-center"
                aria-controls="service-center"
                role="tab"
                aria-selected="false"
                >Service</a
              >
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link disabled">Disabled</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="account-tab-center"
                data-bs-toggle="tab"
                href="#account-center"
                aria-controls="account-center"
                role="tab"
                aria-selected="false"
                >Account</a
              >
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="home-center" aria-labelledby="home-tab-center" role="tabpanel">
              <p>
                Pie fruitcake lollipop. Chupa chups apple pie marzipan danish soufflé soufflé oat cake gingerbread.
                Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar plum
                jelly-o tootsie roll gummies cookie croissant cotton candy. Bear claw lollipop liquorice chocolate
                topping dessert macaroon dessert dragée.
              </p>
              <p>
                Jelly-o gingerbread chocolate carrot cake chocolate soufflé cake macaroon cheesecake. Donut sesame snaps
                bear claw. Chocolate bar tootsie roll sweet wafer chocolate cake dessert icing. Cotton candy chocolate
                bar soufflé lollipop. Jelly beans cookie sesame snaps donut.
              </p>
            </div>
            <div class="tab-pane active" id="service-center" aria-labelledby="service-tab-center" role="tabpanel">
              <p>
                Lemon drops caramels macaroon muffin. Icing chupa chups cupcake chupa chups cheesecake chocolate cake
                jelly marzipan. Candy icing apple pie powder dragée bear claw sweet roll. Dragée liquorice ice cream
                jujubes. Lemon drops lollipop donut cupcake macaroon icing. Wafer lemon drops jelly. Bear claw candy
                wafer wafer jelly cake biscuit.
              </p>
              <p>
                Liquorice tootsie roll cheesecake muffin chupa chups toffee toffee. Pie sesame snaps biscuit sweet roll.
                Tiramisu cake oat cake croissant halvah candy brownie croissant. Bonbon sugar plum muffin tart brownie
                macaroon lollipop dragée. Jujubes halvah cheesecake.
              </p>
            </div>
            <div class="tab-pane" id="account-center" aria-labelledby="account-tab-center" role="tabpanel">
              <p>
                Danish tiramisu donut chocolate bar. Toffee oat cake candy toffee pudding soufflé lemon drops. Gummi
                bears cake oat cake. Tiramisu sugar plum sugar plum cake marzipan cake. Wafer muffin marshmallow biscuit
                oat cake sweet roll danish. Chocolate jelly topping dessert donut. Cheesecake jelly-o carrot cake carrot
                cake candy canes jelly.
              </p>
              <p>
                Wafer chocolate caramels jujubes biscuit powder marzipan. Lollipop gingerbread muffin. Tiramisu brownie
                tart marshmallow wafer sweet caramels croissant chocolate bar. Sweet marzipan toffee muffin sugar plum
                marzipan. Soufflé bear claw muffin cake powder danish dragée.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Centered Aligned Tabs ends -->

    <!-- Tabs Aligned at End starts -->
    <div class="col-xl-6 col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">End</h4>
        </div>
        <div class="card-body">
          <ul class="nav nav-tabs justify-content-end" role="tablist">
            <li class="nav-item">
              <a
                class="nav-link"
                id="home-tab-end"
                data-bs-toggle="tab"
                href="#home-align-end"
                aria-controls="home-align-end"
                role="tab"
                aria-selected="true"
                >Home</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link active"
                id="service-tab-end"
                data-bs-toggle="tab"
                href="#service-align-end"
                aria-controls="service-align-end"
                role="tab"
                aria-selected="false"
                >Service</a
              >
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link disabled">Disabled</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                id="account-tab-end"
                data-bs-toggle="tab"
                href="#account-align-end"
                aria-controls="account-align-end"
                role="tab"
                aria-selected="false"
                >Account</a
              >
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane" id="home-align-end" aria-labelledby="home-tab-end" role="tabpanel">
              <p>
                Pie fruitcake lollipop. Chupa chups apple pie marzipan danish soufflé soufflé oat cake gingerbread.
                Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar plum
                jelly-o tootsie roll gummies cookie croissant cotton candy. Bear claw lollipop liquorice chocolate
                topping dessert macaroon dessert dragée.
              </p>
              <p>
                Jelly-o gingerbread chocolate carrot cake chocolate soufflé cake macaroon cheesecake. Donut sesame snaps
                bear claw. Chocolate bar tootsie roll sweet wafer chocolate cake dessert icing. Cotton candy chocolate
                bar soufflé lollipop. Jelly beans cookie sesame snaps donut.
              </p>
            </div>
            <div class="tab-pane active" id="service-align-end" aria-labelledby="service-tab-end" role="tabpanel">
              <p>
                Lemon drops caramels macaroon muffin. Icing chupa chups cupcake chupa chups cheesecake chocolate cake
                jelly marzipan. Candy icing apple pie powder dragée bear claw sweet roll. Dragée liquorice ice cream
                jujubes. Lemon drops lollipop donut cupcake macaroon icing. Wafer lemon drops jelly. Bear claw candy
                wafer wafer jelly cake biscuit.
              </p>
              <p>
                Liquorice tootsie roll cheesecake muffin chupa chups toffee toffee. Pie sesame snaps biscuit sweet roll.
                Tiramisu cake oat cake croissant halvah candy brownie croissant. Bonbon sugar plum muffin tart brownie
                macaroon lollipop dragée. Jujubes halvah cheesecake.
              </p>
            </div>
            <div class="tab-pane" id="account-align-end" aria-labelledby="account-tab-end" role="tabpanel">
              <p>
                Danish tiramisu donut chocolate bar. Toffee oat cake candy toffee pudding soufflé lemon drops. Gummi
                bears cake oat cake. Tiramisu sugar plum sugar plum cake marzipan cake. Wafer muffin marshmallow biscuit
                oat cake sweet roll danish. Chocolate jelly topping dessert donut. Cheesecake jelly-o carrot cake carrot
                cake candy canes jelly.
              </p>
              <p>
                Wafer chocolate caramels jujubes biscuit powder marzipan. Lollipop gingerbread muffin. Tiramisu brownie
                tart marshmallow wafer sweet caramels croissant chocolate bar. Sweet marzipan toffee muffin sugar plum
                marzipan. Soufflé bear claw muffin cake powder danish dragée.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Tabs Aligned at End ends -->
  </div>
</section>
@endsection

@section('page-script')
  <script src="{{asset('js/scripts/components/components-navs.js')}}"></script>
@endsection
