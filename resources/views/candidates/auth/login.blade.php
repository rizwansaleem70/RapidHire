@include('candidates.auth.layouts.header')

<style>
    @media (max-width: 767px) {
        .col-lg-6 {
            margin-top: 10% !important;
        }

        h4 {
            font-size: 24px !important;
        }
    }

    @media screen and (min-width: 1200px) {
        .social-buttons-container {
            align-items: center;
        }

        .card {
            width: 500px;
        }
    }

    .card {
        background-color: #fbfcfc !important;
        border-radius: 20px;
        border-color: black;
    }

    .social-buttons-container {
        display: flex;
        flex-direction: column;
    }

    .social-buttons-list {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .social-buttons-list li {
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .wd-form-login button:hover {
        background: black;
    }
</style>
<body>
<a id="scroll-top"></a>

<!-- Boxed -->
<div class="boxed">

    <section class="account-section" style="background-image: url(./app-assets/users/images/used/Signin.png);
  background-size: cover; /* Adjust the background size property */
  background-repeat: no-repeat; /* Prevent the background image from repeating */
  width: 100%;
  height: 100vh;">
        <div class="tf-container">
            <div class="row">
                <div class="col-lg-6" style="margin-top: 15rem; text-align:center;">
                    <h4>Hiring software that empowers
                        decision makers to automate
                        their recruitment process</h4>

                    <div class="author-group">
                        <div class="avatar" style="margin-top: 1rem;">
                            <ul style="display: flex; text-align: center; padding: 0 18%;">
                                <li>
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/karen-nelson.png"
                                         style="width:50px ;border-radius: 50%;">
                                </li>
                                <li>
                                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBUVFRgVFRYYGBgZHBoaHBkYGhwYGhkcGhgZGh4YGhweIy4lHB4rIRgYJjgmKy8xNTU1GiQ7QDszPy40NTEBDAwMEA8QHhISHjEsJSs2NDQ0MTQ0NDQ0NDE0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ0NP/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABAIDBQYHAQj/xAA8EAABAwIDBQYEBQMDBQEAAAABAAIRAyEEEjEFQVFhgQYicZGh8BMyQrEHUsHR4RRy8WKCkiMzorLCFf/EABoBAQADAQEBAAAAAAAAAAAAAAABAgMEBQb/xAAoEQADAAEEAgIBAwUAAAAAAAAAAQIRAxIhMUFRBBMiYYGRBTJScbH/2gAMAwEAAhEDEQA/AOrIiIQEREAREQBERAEREAReOcAJJgC5JsAOJ5LU9rdusPTllIiq/TNMUwf7/rPJtjGoUN4JwbNiMUxgl72sb+Z5DW/8jZRWbYpPJFMuef8AQ0x/yMCOa5fice6u/wCISaj/AM7rhm4NYyMrNRaPHisjgsJVaMz3Pk3guJcd0losNdb+Ko9QuoN8qbZYHhgaS7fEEN8SDHr/ADLOOpixewHgXtn7rmOPovcLucBaM7mtzTwY0OPoDdeMzssRa3ytE+MEBR9hP1nVmPB0IKqWgYHbFek0EB7w2xaGtBjhlJzeXFbdsjbFPEtzMNxq02cOhurqkyjloyKIEVioREQBERAEREAREQBERAEREAREQBERAEREACx+2tsUsNTdUquAA0G9x3NA3laT+JPac0W/07PjNe8AyCGNAzC4IGZ08iNei5SWve+CS9x1Mk+u9HwSjbO0Pamvj3ljTkpDRgNgPzPA+Y+xG/FUcK1zw0BzyNxO4/U46NHBo3DjJNukwMGUGXbwDvHhpHK6sVcU1oyuOYT8jDkZ4ucLv47tFk3kulg2rA7QbTORjc7xY5TLG6QA4kT5gFbBQqOeO+7ILGAR5kgC/gCLLnWG2k/RoZTadABujdNyti2VjCNNd5MF3g3c0GOIHJUawaJ5Nmr4dmUmHkEXJcWTzGSJ8Y6qA5zm2YyY+UxnOsfUXH7dVcdjyAA+oxpOgLjmJ5Q0OnkCFg8RtKkxxDzXe43yBrWW/tHfj/U5MZJyZluPf9WfXe2gPSHGN91dwe0GZvl+E6ZDgWiTGpDQIOn8QtQxPaa85MjZtNyeAFzI9FExO36r7BzWD/cDv/KDG+5U4ZVtHWtn9qXNdkqZXji0htQdD3XCLm4I5racNXY9oexwc07/ANCDcHkV89bN2o9r7vm9oyiD4f4XS+ze2sru6S6YDmQQTzaDrEm/LnC0mn0ylSu0b6URrgQCLg6IrmYREQBERAEREAREQBERAEREAREQBCUWM7R4oU8O9xbmtEGcpm3ei+XiN/ISQByH8QO0YxNdzKQaWNJAdBzOOhfP5eHIDpqtJj4IY0EgHNJAMTwJFtR0WXxbHS3I1pfUJccrQxmWT3oA7rZDr8AOSh4jCVGgFrcwbEmwBcQDAjhby86Oi6RGFJ0DOdfpadY4uEhSaGy3vMtaANARp53nxzLz4j2S8tzE6OeL7jPI+CivxL3nvOzH/Uq5b6LY9mbZsSs2clNrzxzx6anrKlnZWIAzVXuYB9FCm8uFtz8pym+4LAYPFNbdzni9smTzgg+a2TD9raNNo7lVzhvz5df7YMeSjktwWxW+GMlHD1nuPzF7apL9Zz2Zm8ijMLiH92o3Kwx3B3AL8GtgOHjOsq/T7cYmu8Mw9FjSebqj/HM+zfLqpFfY21q/ee4Dk2q1sDpmI6QmfYxnoqGAoUZc6kWO/wBRBdzcWmS7xgqxWxOGFywMzXAa2M0/VlmI3WglWH9ncTTJLrHXMGufcbw7K6PEAKDXqOph3fzE/NmBdfiXGPe5VyTgsbQwTCc7Aw6f9uWHX8jiQel1svZzFNcGGoRazXXzDLDhfWx9Bylai/Fsce+OrRB11BN55rNbEDXOHfcZEay7fDo0JE7uG+6sVO4YR0sHqrqxfZioXYZgc7M9oyu3XGluERHKFlCtjEIiIAiIgCIiAIkIgCIiAIiIAiIgPQtY7e4oNoCnvqOy/wC3V0c4HqtmC0f8RJD6DzoM8C+tug1B0kxyvD6JXZpVUlj3vdYNbAHEwGhttwECBvngqMG91U5AJiwFsjQNGnmJ0HnMxh9q4sueGSdGCBrOXT1jzW59gtnD5jc+jfBYV0bz2Xq/Z4FneAmPD7LXMT2Ygktsus1aII0WMq4QcFnyujbCfaOQYnYtRpsAeRFo+4PMKzh9kOA74dbhDeklpXWXbMbwVL9mNiI15KVdEfXPZyjE18Q2zJY0aBnd8yLkq/gNt4ilpM8SAfRwI9FvWM7Pg3AWFxOxCJgJvXlD6/TMcztfiDZx8qdP9WH7K43tC91u84ndkaf/ALb9lQ/ZW4hVt2TPH/kR9im6RtZCxE1NaV9JcfheuYjosjszYzoLszqb9wFSWHkQ0ZliNoMfQ0YzhPen/wBlj6OJk3t1Lo5Q4kLRZxwY1hPk7f2HfLXy5peCJDZiI1veJIuea2tc8/CRxLaxLRPcvF75rTzgHouiFbLowfZ4UQopAREQBERAEREAREQBERAEREAWn/iXQzYem/8ALUH/AJNNvQHotwC1L8UJGDa6CYqsmNwyvBJ5aDqoroldnGq0/Ee4gk5jA33JAHofNdK7AiGRw1vN1z3EU+8SNDF5i2hMnTf4LpXY/BllMHeb9Fz0zohG2m6supK9Tad6FwG9VNiN8BVChyV0VQrnxmlSkiHkiPw07lBxGzxwWYDwrT6gUNInk1qvsmdytDZsLYXvHELwUw5V2k5Oe9scAPhZuBWiUqBJAPsf4XY+02Az0HiJtPkuXbMptcHGYAIF9RJAI6i/QrWXhGGosvJ078JoNPERqHtb0ykj1Llv60f8KKYbh6toLqgPi3I0DpObrK3grddHO+zxERSQEREAREQBERAISESUAREQBERAetC0PtBj/wCpbVpPb3O8G8QRImFvjFpm0sOym6q99gXkDz1+yw120lg6vizLb3LxwcmNN7P+m/UPBHIGRrwldmwTQxo4AX5CNVzLbnwy8NZmMuGYxAgkd0XvofNdHxQ/6UfmaBv0twWbeUmabNtOTX9q9sKznFmGYXAWBaJJ5zp74rF1trY8GXMeRyDDbmMyu7U2o+mAzDMLzvc0Axy4T9lreJr4+odXsuRAdknj3jY9B0Uz+RWlj2ZLEdrcY23wnDj3S63iNFmuzHaZ9Z5Y8QYkaz69Fp2Hw2Lb3iXudmgtJBsALyTGs/wto2JTqfEbnZBMTIGYTuJCingmU3zz+5t+JxeVjjMQCZ6Lm2O7W4l2YMnObS0GwtoB/aF0jtDgyzDuc25A04rmGJw+JAAYyM1yRlGvWZ9yonhlqWUSMPtDaFYZS0i9jZp9TPopbcJtBnezh0xYVMzvMtssC7Y+KuQSTJuXXIm3dE7llNnYbHMeAGmJO+JH9un2/fSuFngzlZeGmb5sDaL67HMrNy1GWdY3B3+i5e3BObUxLGjV72ibRlc436feF1PYryXS5ha6IIMDqZg/fotKqjJj62Zshr3WnjDmnnr7hZquGyzjdSRuXY7FVAcPSy5WZLtAuTkMk9R6Ld1guzT2vh8QQ0tFtxc0/v5rPFb6OduWY/Ixuwl0jwohRamARAiAIiIAiIgCIiAIiIAiIgAKwG38O1zyx0Q8S0n80aeNis+FE2thG1GX+kzI1HMdQCqWsya6N7aTOVbQ2aQGNc3K41mt0iRldB8CR6LoGIoZgAAAG7yJmOC17tM3KWVXSMjxB5QTfhotmw1YO8FyrrB2VW6nRBfs9zh3YHJxIB6NsPVYjFYTEDulnUQ7yMLbxC8fTnfClSMmn4bZLxciPHd4AWWWwmBAIPhfqsk5gJgGeQV+nTIiyjbyS2XMfQz08vFa1iNmAyIHgdD+y297ZaoFVhiSOqtU+TOWaf8A0DwYa145fMOk/uszs/Zrxd0jnPeP7LLUXMOhCv8AxAqqV7Luv0I4bET3uExI6hajU2aam0KoEZHU2PM8i31ufNbjUe023/stb2K/PicQ/wDK4NnSzdB5z5BTjgrnDTNm2I1pDiwd0QxvONSskVRhaYYxoaIETHj7CqK6pWEjjut1NhERWKAIiIAUREAREQBERAEREAREQBNbHQoiA0/t3gAzDFwcSM7AGkaS8fVwABUbZ+P7rRx/b/CyX4jtd/QVSPpLHdBUZPvxXOcLtB2QQbiCOZusNSEuUdGnqNvDOi1MdkEuMALG0doPxDpbIp7iNX+HAc1h8XijWwzXg92W5xyDgDP38Co9Db8AsESAYvEmwjkOfNc/+zqzhGyYragwpDsri1wjjBBmOs/ZVYPteyoYu08DH3BI8ytQ21iKtVuX5mgSPEcfstTxNOpTBLQWmTJEg2O/zV1z0yHSXaO11e0bGtkkAc7LDn8QKJeKbAXucYGUd3zMWXJX7Xr1crHPc4e7mNYWc2Dsyo1we0XOjuBEiR5z7tLTXbKKlT4R0PE4BzRnpvLXa8WmbxHBW8Dtt0mnUGV43HQjiDvCxdTar2N75M8+g671Bw9U16jS0yGHNn4Aaz46dVm/0NU/DNsqY7K9s7152DpU3/GLpLxULokxlcBlnc7Rx6+Wk4vbGes8C4bDWxy1PqSt97AYYtoueQQXkG9p7ov1W2jPs5tavRtriqUlF0nKEREAQIiABCiIAiIgCIiAIiIAiIgCBEQEHbeDFbD1aZ+tjhx3FcDoPcyWukRr5/wvooLi/wCJWxTh8R8RghlUlw4B0y5vmZHJVtZReHhkLsntOHvovPceHa8T+hUatsX4tVzGOPdMTMbuSwWFxGV7SNQbfotx7MVJcXuuDAHQ7ucz6rnpbXlHTL3LDILtn43DuGV7nsEWMExaW3BIMWWT2Z8SqSx4LDDic7O6QCIEi03PqttY8ZZIGmnFWa+Ops8uAixiL6Kuc9m04S9GvHBObmANMFs5Q1kk2Bm1xckLF1a+PMhjC0cXNIHOxOq3dm0WcR5BSqWIY65M+/fmp4J/c0Gn2fr1GmpiajnR8rdBbeQB0UlmMZhsJUyRne4s52i3TMts2pUbkcftaB7lcq2riMzy0G0k+JIEHxgIluZjdY5Re2MwveGiZdlnfff0gz0K+gdnYQUqTKY0Y0DquYfhdsHO84h47rNLWc83id+WV1kroleTmt+DxERXMwiIgCIiAIiIAiSiAIiIAiIgCIiAIiIAsR2q2azEYZ7HjWIO9rps4eH7rI4nFspxncGSYBdYTzO5Y/bOKBhjTIFyRx9/dUqkk+TWJbaPnraez30KhY8QRv3OH5gd4U/Ym0SxwJJMbtwOgOvBdA23gGVwWvbOsHe3mFzjaezn0HkCS2xzRwAufAlc86irh9m9Q5/JG+4DaQf3W/S0mSY3aDUnQ+Y8BF2jQqPHcaSbW4SDczpr6rVtmbROYAxJIF+AgXK3zC7RY8FwIBIB/LqIED3vSpwTNZNbpbPxOfMWPAPGwIgnjY39VtGzKbg0l2438hp09CppxzHtOhMgZekDerGL2mxrDli0eW8kDkD5KHhl1wjA9pdpwGjN3RIMTEiL6mdN43LV+zOx3YzEMpttJ753NAN3SfQakrzGYs1nuawEl0Cd/MjlYG9oJ426L2J2cMPcRnsXO4mx8lbcpwvLMtrrL8I6DgMCyjTbTYIa0QOfM8SrpVVN4cMw3+nJeOC6UcrKURFJAREQBERAEREAREQBERAEREARFbfVA5ql3MLNPBaZddFwBWcTigy2pUXEYw6LF4upImdOfv8AVeX8j+pTKcx37OvS+K280e4yuyo4ZgHQ7MJ0zDQ84n1Ci4l8yodZ1/Y048Nek73FVPrZvEarH4vyHac132dN6e3DXRFrb1icUwOsRI4LL1gsTiTC6CUartLs6Sc9E75y6RvsT4ac1Hw+Lq0e49kWEE6xv5cVtrXArx7QdbjmtPtaWHyU+mW8rg1AbWfE3uZtuuIP8cua8IxFYQSWt4mRN5J+y2N9NvAdAjWgqPu9Iv8AT7Za2HstrMp1cN/n5C63vZoiFg8BQhbDhWWCzTbrLFJKcIzVGqWiQSPBSsPjw75vP9wsPUqSMo/fp48t4VdE7vduB3+BuFjfzajUxPS7Ma0E1ybAL3C8hQKFYi6mMxAOq79H5kWueDlrRc9FcIqhB0XhauxNPoxaweIiKSAiIgCIiAIipc+FnerM9stMN9FStuqwrfxJVshcOr8yn/abzoryKldRX1Crr2qLUC8nX1bp5pnXESug8SFBrNI/XzU5jpVuq2VyX+SyjeXhmGrNgx4R+ke4HzG6hudGkW8YiJjwgT0k/MstiGSI/n/IWLqggkGx14855jfzMDQJpajlpp8o3SVLDD6gc3nv4grF4tTHsEGZHMG4iLc4Hq0rE4im/wDMD4gg7hune4DzXr6fyZvvhmD0qnrksfGhUPxQ4rHYsVB9PHQjcY+6gkVT9J37wP1XUlLXaM/yT6Mu7EjSVOwLZKwNDA1Cbga8eAlZ/AYVzdXAeEn6c3KbBZ3cT5LJXXg2LBsAhZMVABAueHr5xJA3wsVh+EnhJ1+YtkDQXDf+Sm0jNhvjxEk25w4W8SvP+R8vjbH8l1pPuiXTd148DvifUHdop9Gnx/z481Gw9OLnX7b4858FNDoC49PnllbfouufuXrSo9IZipbbLoim+TGljguNfFyq6eKJO6OaiGXHgFIpsAC6tPWtP8XwZVE45JgeCvcqjA8FUKgC9GPl/wCSMK0vRdhF42pO5etIK6p1orpmVRSCKrKi04KER1SF4XKy91lbY9fO3rPOGeio4KyYKqzqPVfp4pnusPsxlF9pcL1ae4LxxVDljdMukUCziqjdWibqtxWafBctvYoOIoTqPDkeIU571aeVjWE8o1lswj8Pum3rGmm+xdfi5QqjBN+MnzLz6kDos7XpAqDVYRabLWNTJumYGrhZt/aOs5io39Nr4H1dK2B9En3/AArfwCPcLpnWZGCBQw4zCSPmPkWqbQpCAJ3N0N/kcD+iusaRvUmmHOtNvus7tsno9pUSdTGuuskN3DmDrCyuGpxoONzc3MnwVqgwBTKZ4Ln3bmZXRdFlW7gqN69abrSTnZJpwLBePduVtrl6y5W6rhJGePJdYYVwOVpxXoetJrBVouuqQF7TG8qKHS5XHVICtOpzlkOSS6pCra5Q6L81925SGv4LaNXPJRzgkfFPFeK3KLb7r9ldqIeberU3lCVS5y8t0dCQe/TxVGfv9EOsK013fPvks6r/AKXSL8ovWN99VU4KcEEepqvXJW0VLtFm/JddFDm3VohXXLyFm0XTI7wrL6alOaqHMVOjVUQ/hqh7VLc1R6oWksuqIwZJU2izkqaLFJY1KrPBFUVsCvsVDQrgUJGFPJWHKqm1UPKusC2SMmz0AK6xWmBXdy1kozx3vyVLn6r15sVZcdB1R0SkVtMCd/qj3XA5ffn5rxx0C9Z8xPC3JM+B+pIbaArrTAkqyy+qh4uuXOyN6kbh+61VKVn+CqTbwTf6tvH1H7rxQv8A8tvPzXqj7NT0W2R7LtTXp+oVB3oiwfZKPP2crTPmKIqV3+5aeiYxeFeotPBUsP081Rw8ERZey6Kf5VLtPfAoioWKffoqf4+yIs2aIoqaef3Uarr1K8RXRZdl4K8P3RFTyKLzP2VY098ERaIxZWNegVw6++K8RbIyZUzcro9+SItJIZZraHoqDqPfBEVH2yUHa++CqH1e/wAqIgZfGnvgoGzfnf4j7Ii1ruSJ6Zl0RFsZn//Z"
                                         style="width:50px ;border-radius: 50%;">
                                </li>
                                <li>
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR6AaMq5ZoIgqjI2s1z8U1UKeFq1EXajThx1iTQX1Y7LSxkGbsp2Fh52rHOk1j5xVAQmxs&usqp=CAU"
                                         style="width:50px ;border-radius: 50%;">
                                </li>
                                <p style="margin-top: 3%;margin-left: 4%;">3k+ people joined us, now it's your turn</p>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-lg-6 wd-form-login " style="float:right">
                    <div class="container card" style="padding: 4%;background-color: fbfcfc;">
                        <strong><h6 style="text-align: initial; margin-top: 2%;">Sign in</h6></strong>
                        <div class="sign-up" style="text-align: initial;"><strong>New User?</strong><a
                                    href="{{route('tenant-user-signup')}}" style="color: #0A66C2;">Create an Account</a>
                        </div>


                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                        @endif

                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{session('message')}}
                            </div>
                        @endif

                        <form action="{{route('tenant-user-login')}}" style="margin-top: 5%;" method="POST">
                            @csrf
                            <div class="ip">

                                <input type="text" placeholder="Email" name="email" style="border-radius: 20px;">
                            </div>
                            <div class="ip">
                                <label>Password<span>*</span></label>
                                <div class="inputs-group auth-pass-inputgroup">
                                    <input type="password" class="input-form password-input" name="password"
                                           placeholder="Password" id="password-input"
                                           required="" style="border-radius: 20px;">
                                    <a class="icon-eye-off password-addon" id="password-addon"></a>
                                </div>
                            </div>
                            <div class="group-ant-choice">
                                <!-- <div class="sub-ip"><input type="checkbox">Remember me</div> -->
                                <a href="{{route('tenant-user-reset-password')}}" class="forgot"><strong>Forgot
                                        password?</strong></a>
                                <button type="submit">Sign in</button>
                            </div>
{{--                            <p class="line-ip"><span>or</span></p>--}}

{{--                            <div class="social-buttons-container">--}}
{{--                                <ul class="social-buttons-list">--}}
{{--                                    <li><a href="#" class="btn-social"><img--}}
{{--                                                    src="{{asset('app-assets/candidates/images/review/google.png')}}"--}}
{{--                                                    alt="images"> Sign in with Google</a></li>--}}
{{--                                    <li><a href="#" class="btn-social"><img--}}
{{--                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACXklEQVR4nO3ZT4hNURzA8c8YjI1QkgzZkIX8S0ZS/pQ/+VNSipLIwkJZWhEWwkIhCzYWlGQhLCTKylr5v7CQxEwTwjCaGeXq1pl6vd575r1333vnar71W713zznfe86555zfYZS6WYLLeIZDcshs3EdSEIfljG3oK5JIY68csR1DJSTSmCcnzMGPMhKv0CYnPCojkcYBOaGrgsRTjJMTLpWR+I5FcsSLEhLpfFkpZwwVSTwOkz8a2sLithQLManM/9K3341b2IwxRb9PxeJQzly0axIrcBWfSwyZdBidDI0apngypyJrcAHvSpTRhyuhnobQibsVvkDF8RbnsBvrsAvn8aGKMu6FejMjfYNfqmhAlvEVW7OQ2IDBFkkkIdL6t9QjMR8/WyyRFCyeE2qRGIvnEQgk4dzSUWtv7I9AIMFZddAevjqtlnhYYt2piuURSAxlsQM4FoHITRlQfKZuRezIQuRlBCKdWYh8a7HE73on+TCDEYj4H3okwZQsRHoiEFmVhciTCEROZyFyPQKR3lo3iYUciUAkySInvD4CiQT99aaMOiqkOJsd7+vNDd+OQCIJ8SkkwWtiTwQCSYltfZp6qnp49UbQ+KQg/mBBLb1yKoLGJwVxR43MwkBEvdGlDs5EIJHgmjqZGHK3rZTowwwZsK/FIgdlSDV53yzjQdZ3jNNasL3vwXQNYFkTty79IS3VMDY24Sg8GC6FGs7qfwyz9BLoIjaFJFt6bJ0Z7g2P4k2FZ7uzOh2OlPSq7XhIHQ2Exqf5sJ0YP4Ln1+IGPuIXXuMEJjeh7aOMYoT8BfcegYzf+KxLAAAAAElFTkSuQmCC"--}}
{{--                                                    style="width: 30px;"> Sign in with Apple</a></li>--}}
{{--                                </ul>--}}
{{--                                <ul class="social-buttons-list">--}}
{{--                                    <li><a href="#" class="btn-social"><img--}}
{{--                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAByElEQVR4nO2ZP0/CQBjG22scXI2Tiauy+glc3MC4+iX8DA6G9IiDJsYBBhdNHJwcNRGIHY3xjoBCgkTEAUP8A63yt7ymBVQEIq2mvSb3JM/UN5fnd+97N1wFgYuLi4tpSTJdQTKJI5lqCFNwxDLVRExjkkyW/xRexAQ7FhoPt4hJ0P7OuxwedS2FSMAygDk2DIRHRhdkGrUOgInqdnDUs0wqNgAYCI6//G8AvkgazgsaaA0dlIIG8+G0twCUggbfFb/XvAWgNfQ+ALWuewtA8XoHfJG0CWF0IpZXYS584y0A5JIFDoA7OzFM43yf3b2G7YsSpEpVqDbb8FprmaO4dvoAk5sJtgEW9jLw+NaEUbosvsPMTopdgOxLHX5TLK+CxCrAuPIf5dgE0Ntgzv/S4S2sHucheqcOrdtPPrMJsK4U+2omQgk4yVUG6jJPNTYBpreTA+ssHmQH6sq1FnsA7R/fe57aSo5d63oH7K6FOADmHTDFRwjzQ0z5LYT4NWpRo24Otyx4+mkR07JlAON9noHgYFjE9MwygPFzwe3gqGsJX/ktA3S6QIJuhxcx2bAV/rMTIRIw3uedPRNENcbG9s5zcXFxCU7pA5Jwntel+S2tAAAAAElFTkSuQmCC"--}}
{{--                                                    style="width: 30px;"> Sign in with Linkedin</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}

{{--                            <div class="sign-up">Protected by reCAPTCHA and subject to the Rapidhire Privacy--}}
{{--                                Policy and Terms of Service.--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 5000);
    </script>


</div>
<!-- /.boxed -->

@include('candidates.auth.layouts.footer')
