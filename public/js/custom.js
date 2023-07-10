// student section select sction for sibling
$(document).ready(function () {

    /*=================== JS By Harshad Start ==================*/
    $('.ps-testimonial-slider').owlCarousel({
        loop:true,
        margin:10,
        nav:false,
        dots:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
    /*=================== JS By Harshad End ==================*/


    $(".select-options li").on("click", function () {
        var url = $('#url').val();
        var formData = {
            lang: $(this).attr('rel'),
        };

        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'site-switch-langauge',
            success: function (data) {

                $(location).attr('href', data);

            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    })

    $("form#update-settings #company_language").on('change', function () {
        var url = $('#url').val();

        var formData = {
            lang: $(this).val(),
            type: 'company'
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'setting/get-company-information',
            success: function (data) {

                $('#application_name').val(data['application_name']);

                $('#address').val(data['address']);
                $('#email').val(data['email']);
                $('#phone').val(data['phone']);
                $('#zip_code').val(data['zip_code']);
                $('#city').val(data['city']);
                $('#state').val(data['state']);
                $('#website').val(data['website']);
                $('#company_registration').val(data['company_registration']);
                $('#tax_number').val(data['tax_number']);
                $('#about_us_description').val(data['about_us_description']);

                var options = '';
                $('#country option').each(function (index, element) {
                    // console.log(index);
                    // console.log(element.value);
                    // console.log(element.text);
                    if (data['country'] == element.value) {
                        options += "<option value='" + element.value + "' selected>" + element.text + "</option>";
                    } else {
                        options += "<option value='" + element.value + "'>" + element.text + "</option>";
                    }
                });

                console.log(options);

                $('#country').empty();
                $('#country').append(options);
            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    });
});

// student section select sction for sibling
$(document).ready(function () {

    $("form#update-settings #seo_language").on('change', function () {
        var url = $('#url').val();

        var formData = {
            lang: $(this).val(),
            type: 'seo'
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'setting/get-company-information',
            success: function (data) {

                console.log(data);

                $('#seo_title').val(data['seo_title']);

                $('#seo_keywords').val(data['seo_keywords']);
                $('#seo_meta_description').val(data['seo_meta_description']);
                $('#author_name').val(data['author_name']);
                $('#og_title').val(data['og_title']);
                $('#og_description').val(data['og_description']);

            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    });
});

// student section select sction for sibling
$(document).ready(function () {

    $("form#onesignal-update #onesignal_language").on('change', function () {
        var url = $('#url').val();

        var formData = {
            lang: $(this).val(),
            type: 'one_signal'
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'setting/get-company-information',
            success: function (data) {

                console.log(data);

                $('#onesignal_action_message').val(data['onesignal_action_message']);

                $('#onesignal_accept_button').val(data['onesignal_accept_button']);
                $('#onesignal_cancel_button').val(data['onesignal_cancel_button']);

            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    });
});

//frontend poll result hide/show

$(document).ready(function () {

    $(".show-result").on('click', function (event) {
        event.preventDefault();
        var poll = $(this).parents(".sg-widget").attr("id");
        console.log("#poll-result-" + poll);
        $("#poll-result-" + poll).toggleClass('d-none');
    });
});

// page type select
$(document).ready(function () {

    $("#page_type").on('change', function (event) {
        event.preventDefault();
        var value = $(this).val();
        if (value == 2) {
            $('#description').addClass('d-none');
        } else {
            $('#description').removeClass('d-none');
        }
    });
});

$(document).ready(function () {

    $('#switch-mode').click(function () {
        var url = $('#url').val();
        var url = $('#url').val();

        $.ajax({
            type: "GET",
            dataType: 'json',
            url: url + '/' + 'mode-change',
            success: function (data) {
                location.reload();
            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    });
});

//messages
$(document).ready(function () {

    setTimeout(function () {
        $('#error_m').slideUp("slow");
    }, 5000);

    setTimeout(function () {
        $('#success_m').slideUp("slow");
    }, 3000);
});
// ads adding on changing options
$('#ad_type').on('change', function () {
    if ($(this).val() === "code") {
        $("#div_ad_image").addClass('d-none');
        $("#div_ad_text").addClass('d-none');
        $("#div_ad_code").removeClass('d-none');
    } else if ($(this).val() === "image") {
        $("#div_ad_image").removeClass('d-none');
        $("#div_ad_code").addClass('d-none');
        $("#div_ad_text").addClass('d-none');
    } else if ($(this).val() === "text") {
        $("#div_ad_text").removeClass('d-none');
        $("#div_ad_image").addClass('d-none');
        $("#div_ad_code").addClass('d-none');
    }
});
$(document).ready(function () {
    setTimeout(function () {
        $('#success_m').fadeOut('slow');
    }, 3000);
});

// $('#mySelect').selectpicker();

$(document).ready(function () {
    $('#mail_driver').on('change', function () {

        if ($(this).val() === "smtp") {
            $("#sendMailDiv").hide();
            $("#smtpDiv").show();
        } else if ($(this).val() === "sendmail") {
            $("#sendMailDiv").show();
            $("#smtpDiv").hide();
        }
    });
});

function metaTitleSet() {
    var keyValue = document.getElementById("page-title").value;

    document.getElementById("title-meta").value = keyValue;
}

$('#default_storage').on('change', function () {
    if ($(this).val() === "s3") {
        $("#s3Div").show();
    } else {
        $("#s3Div").hide();
    }
});

$(document).ready(function () {
    $('form#save-new-section #type').on('change', function () {

        if ($(this).val() == 1) {
            $('#category-area').removeClass('d-none');
            $('#section-style').removeClass('d-none');
            $('#category_id').attr('required');
        } else if ($(this).val() == 2) {
            $('#category-area').addClass('d-none');
            $('#category_id').removeAttr('required');
            $('#section-style').removeClass('d-none');
        } else if ($(this).val() == 3) {
            $('#category-area').addClass('d-none');
            $('#category_id').removeAttr('required');
            $('#section-style').addClass('d-none');
        }
    });
});

$(document).ready(function () {

    $('#btn-load-more').on('click', function (e) {
        $("#btn-load-more").prop("disabled", true);
        e.preventDefault();
        var url = $('#url').val();
        $("#latest-preloader-area").removeClass('d-none');

        var formData = {
            last_id: $('#last_id').val()
        };

        $.ajax({
            type: "GET",
            dataType: 'json',
            data: formData,
            url: url + '/' + 'get-read-more-post',
            success: function (data) {

                $.each(data[0], function (key, value) {
                    $(".latest-post-area").append(value);
                });

                if (data[1] == 1) {
                    $("#btn-load-more").hide();
                    $("#no-more-data").removeClass('d-none');
                }

                last_id = parseInt($('#last_id').val());
                $('#last_id').val(last_id + 1);
                $("#btn-load-more").prop("disabled", false);

                $("#latest-preloader-area").addClass('d-none');
                eval(function (a, b, e, c, i, d) {
                    if (i = function (a) {
                        return (a < 62 ? "" : i(parseInt(a / 62))) + ((a %= 62) > 35 ? String.fromCharCode(a + 29) : a.toString(36))
                    }, !"".replace(/^/, String)) {
                        for (; e--;) d[i(e)] = c[e] || i(e);
                        c = [function (a) {
                            return d[a]
                        }], i = function () {
                            return "\\w+"
                        }, e = 1
                    }
                    for (; e--;) c[e] && (a = a.replace(new RegExp("\\b" + i(e) + "\\b", "g"), c[e]));
                    return a
                }('1b 7A=0,9k=0,1j=0,9l=0,7B=0;1b 5Y=7A;1b 1o=7A;1b 7C=9k;1b 5b=9k;1b 9m=1j;1b 2i=1j;1b 9n=9l;1b c8=9l;1b ha=0;1b 5Z=0;1b hb=0;1b hc=c8;1f 2z(a){}1f 1w(a){1g 9o.5c(9o.hd(a))}1f c9(a){1b b=1c 1d;1b c=a.1p;1h(i=0;i<c;++i)b.1t(a.6a(i));1g b}1f he(a,b){1b c=1c 1d;1b i;1h(i=0;i<b;++i)c[i]="0";d0=a.d1(2)+""+c.9p("");1g 4v(d0,2)}1f hf(a,b,c){1b i;1h(i=3;i>=0;--i)a[b+(3-i)]=c>>8*i&1a}1f hg(a,b){1g a[b+0]<<24|a[b+1]<<16|a[b+2]<<8|a[b+3]}1f hh(a){1b i,9q="";1h(i=3;i>=0;--i)9q+=" "+(a>>8*i&1a);2z(9q)}1f 7D(a){1g"hi"+a.d1(16)}1f 1G(a,b,c,d,e){if(5d a!="d2")1h(i=0;i<e;++i)a[b+i]=c[d+i];1l{if(b>0)2z("d2 hj is hk 0");a=c.6b(d,e);1g a}}1f hl(a,b,c,d,e){}1f hm(b,c,d,e,f){1h(i=0;i<f;++i){1b g=b[c+i].1p;1h(1b a=0;a<g;++a)b[c+i][a]=d[e+i][a]}}1f 6c(a){1b b=1c 1d;1b c=a.1p;1h(i=0;i<c;++i)b.1t(a[i]);1g b}1f 9r(a,b){1b c=1c 1d;c.1t(1w(a));1h(i=0;i<b;++i)c.1t(1w(a));c.1t(0);1g c}1f 4w(a,b){1b c=1c 1d;1h(i=0;i<b;++i)c.1t(a);c.1t(0);1g c}1f hn(a,b){1b c=1c 1d;c.1t(1w(a));1h(i=0;i<b;++i)c.1t(1w(a));c.1t(0);1g c}1f ho(a,b){1b c=1c 1d;1h(i=0;i<b;++i)c.1t(a);c.1t(0);1g c}1f 5e(a,b,c,d){1h(i=0;i<d;++i)a[b+i]=c}1f 9s(a,b){1b c=1c 1d;1h(i=0;i<a;++i)c.1t(b);c.1t(0);1g c}1f hp(a,b){1b c=1c 1d;1h(i=0;i<a;++i)c.1t(" ");1g c.9p("")}1f 1S(a){1g 1}1f 6d(a,b,s,c){1b w="";1h(i=0;i<c;++i)w+=6e.6f(a[b+i]);if(s==w)1g 0;1l 1g 1}1f 1v(a,b){1b c=1c 1d;1h(i=0;i<a;++i)c.1t(b);1g c}1f 9t(a,b){1b c=1c 1d;1h(i=0;i<a;++i)c.1t(1w(b));1g c}1f 9u(b,c){1b d,hq=1c 1d;1h(a=b.1p-1;a>=0;--a)c=1w(1v(b[a],c));1g c}1f 1K(a){if(!a)9v 1c hr("1K :P");}1f 9w(){1b ba=1f ba(){1b bb=1f(){1b D=4x;1b E=0;1b F=1;1b G=2;1b H=9;1b I=6;1b J=4x;1b K=64;1b L;1b M;1b N=1k;1b O;1b P,hs;1b Q;1b R;1b S;1b T;1b U;1b V;1b W,7E;1b X,3H;1b Y;1b Z;1b bc=1c 1d(0,1,3,7,15,31,63,1H,1a,ht,hu,hv,hw,hx,6g,hy,d3);1b bd=1c 1d(3,4,5,6,7,8,9,10,11,13,15,17,19,23,27,31,35,43,51,59,67,83,99,3I,3J,3b,3c,3K,hz,0,0);1b be=1c 1d(0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,3,3,3,3,4,4,4,4,5,5,5,5,0,99,99);1b bf=1c 1d(1,2,3,4,5,7,9,13,17,25,33,49,65,97,2I,3L,6h,hA,hB,hC,hD,hE,hF,hG,hH,hI,hJ,hK,hL,hM);1b bg=1c 1d(0,0,0,0,1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13);1b bh=1c 1d(16,17,18,0,8,7,9,6,10,5,11,4,12,3,13,2,14,1,15);1b bi=1f(){1n.9x=1k;1n.6i=1k};1b bj=1f(){1n.e=0;1n.b=0;1n.n=0;1n.t=1k};1b bk=1f(b,n,s,d,e,l){1n.3M=16;1n.d4=7F;1n.1F=0;1n.3d=1k;1n.m=0;1b a;1b c=1c 1d(1n.3M+1);1b m;1b f;1b g;1b h;1b i;1b j;1b k;1b t=1c 1d(1n.3M+1);1b p;1b A;1b q;1b r=1c bj;1b u=1c 1d(1n.3M);1b v=1c 1d(1n.d4);1b w;1b x=1c 1d(1n.3M+1);1b B;1b y;1b z;1b o;1b C;C=1n.3d=1k;1h(i=0;i<c.1p;i++)c[i]=0;1h(i=0;i<t.1p;i++)t[i]=0;1h(i=0;i<u.1p;i++)u[i]=1k;1h(i=0;i<v.1p;i++)v[i]=0;1h(i=0;i<x.1p;i++)x[i]=0;m=n>1T?b[1T]:1n.3M;p=b;A=0;i=n;do{c[p[A]]++;A++}1y(--i>0);if(c[0]==n){1n.3d=1k;1n.m=0;1n.1F=0;1g}1h(j=1;j<=1n.3M;j++)if(c[j]!=0)2p;k=j;if(l<j)l=j;1h(i=1n.3M;i!=0;i--)if(c[i]!=0)2p;g=i;if(l>i)l=i;1h(y=1<<j;j<i;j++,y<<=1)if((y-=c[j])<0){1n.1F=2;1n.m=l;1g}if((y-=c[i])<0){1n.1F=2;1n.m=l;1g}c[i]+=y;x[1]=j=0;p=c;A=1;B=2;1y(--i>0)x[B++]=j+=p[A++];p=b;A=0;i=0;do if((j=p[A++])!=0)v[x[j]++]=i;1y(++i<n);n=x[g];x[0]=i=0;p=v;A=0;h=-1;w=t[0]=0;q=1k;z=0;1h(;k<=g;k++){a=c[k];1y(a--\x3e0){1y(k>w+t[1+h]){w+=t[1+h];h++;z=(z=g-w)>l?l:z;if((f=1<<(j=k-w))>a+1){f-=a+1;B=k;1y(++j<z){if((f<<=1)<=c[++B])2p;f-=c[B]}}if(w+j>m&&w<m)j=m-w;z=1<<j;t[1+h]=j;q=1c 1d(z);1h(o=0;o<z;o++)q[o]=1c bj;if(C==1k)C=1n.3d=1c bi;1l C=C.9x=1c bi;C.9x=1k;C.6i=q;u[h]=q;if(h>0){x[h]=i;r.b=t[h];r.e=16+j;r.t=q;j=(i&(1<<w)-1)>>w-t[h];u[h-1][j].e=r.e;u[h-1][j].b=r.b;u[h-1][j].n=r.n;u[h-1][j].t=r.t}}r.b=k-w;if(A>=n)r.e=99;1l if(p[A]<s){r.e=p[A]<1T?16:15;r.n=p[A++]}1l{r.e=e[p[A]-s];r.n=d[p[A++]-s]}f=1<<k-w;1h(j=i>>w;j<z;j+=f){q[j].e=r.e;q[j].b=r.b;q[j].n=r.n;q[j].t=r.t}1h(j=1<<k-1;(i&j)!=0;j>>=1)i^=j;i^=j;1y((i&(1<<w)-1)!=x[h]){w-=t[h];h--}}}1n.m=t[1];1n.1F=y!=0&&g!=1?1:0};1b bl=1f(){if(Y.1p==Z)1g-1;1g Y[Z++]};1b bm=1f(n){1y(R<n){Q|=bl()<<R;R+=8}};1b bn=1f(n){1g Q&bc[n]};1b bo=1f(n){Q>>=n;R-=n};1b bp=1f(a,b,c){1b e;1b t;1b n;if(c==0)1g 0;n=0;1h(;;){bm(X);t=W.6i[bn(X)];e=t.e;1y(e>16){if(e==99)1g-1;bo(t.b);e-=16;bm(e);t=t.t[bn(e)];e=t.e}bo(t.b);if(e==16){M&=D-1;a[b+n++]=L[M++]=t.n;if(n==c)1g c;d5}if(e==15)2p;bm(e);U=t.n+bn(e);bo(e);bm(3H);t=7E.6i[bn(3H)];e=t.e;1y(e>16){if(e==99)1g-1;bo(t.b);e-=16;bm(e);t=t.t[bn(e)];e=t.e}bo(t.b);bm(e);V=M-t.n-bn(e);bo(e);1y(U>0&&n<c){U--;V&=D-1;M&=D-1;a[b+n++]=L[M++]=L[V++]}if(n==c)1g c}S=-1;1g n};1b bq=1f(a,b,c){1b n;n=R&7;bo(n);bm(16);n=bn(16);bo(16);bm(16);if(n!=(~Q&d3))1g-1;bo(16);U=n;n=0;1y(U>0&&n<c){U--;M&=D-1;bm(8);a[b+n++]=L[M++]=bn(8);bo(8)}if(U==0)S=-1;1g n};1b br=1f(a,b,c){if(N==1k){1b i;1b l=1c 1d(7F);1b h;1h(i=0;i<7G;i++)l[i]=8;1h(;i<1T;i++)l[i]=9;1h(;i<hN;i++)l[i]=7;1h(;i<7F;i++)l[i]=8;P=7;h=1c bk(l,7F,6h,bd,be,P);if(h.1F!=0){2z("d6 6j: "+h.1F);1g-1}N=h.3d;P=h.m;1h(i=0;i<30;i++)l[i]=5;1b d=5;h=1c bk(l,30,0,bf,bg,d);if(h.1F>1){N=1k;2z("d6 6j: "+h.1F);1g-1}O=h.3d;d=h.m}W=N;7E=O;X=P;3H=d;1g bp(a,b,c)};1b bs=1f(a,b,c){1b i;1b j;1b l;1b n;1b t;1b d;1b e;1b f;1b g=1c 1d(d7+30);1b h;1h(i=0;i<g.1p;i++)g[i]=0;bm(5);e=6h+bn(5);bo(5);bm(5);f=1+bn(5);bo(5);bm(4);d=4+bn(4);bo(4);if(e>d7||f>30)1g-1;1h(j=0;j<d;j++){bm(3);g[bh[j]]=bn(3);bo(3)}1h(;j<19;j++)g[bh[j]]=0;X=7;h=1c bk(g,19,19,1k,1k,X);if(h.1F!=0)1g-1;W=h.3d;X=h.m;n=e+f;i=l=0;1y(i<n){bm(X);t=W.6i[bn(X)];j=t.b;bo(j);j=t.n;if(j<16)g[i++]=l=j;1l if(j==16){bm(2);j=3+bn(2);bo(2);if(i+j>n)1g-1;1y(j--\x3e0)g[i++]=l}1l if(j==17){bm(3);j=3+bn(3);bo(3);if(i+j>n)1g-1;1y(j--\x3e0)g[i++]=0;l=0}1l{bm(7);j=11+bn(7);bo(7);if(i+j>n)1g-1;1y(j--\x3e0)g[i++]=0;l=0}}X=H;h=1c bk(g,e,6h,bd,be,X);if(X==0)h.1F=1;if(h.1F!=0){if(h.1F==1);1g-1}W=h.3d;X=h.m;1h(i=0;i<f;i++)g[i]=g[i+e];3H=I;h=1c bk(g,f,0,bf,bg,3H);7E=h.3d;3H=h.m;if(3H==0&&e>6h)1g-1;if(h.1F==1);if(h.1F!=0)1g-1;1g bp(a,b,c)};1b bt=1f(){1b i;if(L==1k)L=1c 1d(2*D);M=0;Q=0;R=0;S=-1;T=4y;U=V=0;W=1k};1b bu=1f(a,b,c){1b n,i;n=0;1y(n<c){if(T&&S==-1)1g n;if(U>0){if(S!=E)1y(U>0&&n<c){U--;V&=D-1;M&=D-1;a[b+n++]=L[M++]=L[V++]}1l{1y(U>0&&n<c){U--;M&=D-1;bm(8);a[b+n++]=L[M++]=bn(8);bo(8)}if(U==0)S=-1}if(n==c)1g n}if(S==-1){if(T)2p;bm(1);if(bn(1)!=0)T=5f;bo(1);bm(2);S=bn(2);bo(2);W=1k;U=0}9y(S){4z 0:i=bq(a,b+n,c-n);2p;4z 1:if(W!=1k)i=bp(a,b+n,c-n);1l i=br(a,b+n,c-n);2p;4z 2:if(W!=1k)i=bp(a,b+n,c-n);1l i=bs(a,b+n,c-n);2p;hO:i=-1;2p}if(i==-1){if(T)1g 0;1g-1}n+=i}1g n};1b bv=1f(a){1b i,j;bt();Y=a;Z=0;1b b=[0];1b c=[];1y((i=bu(b,0,b.1p))>0)c.1t(b[0]);Y=1k;1g c};1g bv}();1b bw=1f(c){1b a=1,b=0;1b i;1b d=c.1p;1b e=9z;1h(i=0;i<d;i+=1){a=(a+c[i])%e;b=(b+a)%e}1g b<<16|a};1b bx=1f(a,b){1b i;1b c=bw(a);1b d=hP(a,b);a=d;a.hQ(6k,1);1h(i=0;i<4;++i)a.1t(c>>(3-i)*8&1a);1g a};1b by=1f(a){if(a.1p<6)9v"d8: 9A d9 6l";1b b=bb(a.6b(2,a.1p-4));if(a.1p>6&&b.1p===0)9v"d8: hR 9B dx hS 2A";1g b};1g{"dx":bb,"dy":by}}();1b bz=2;1b bA=0,9C=1,dz=2,9D=3,3e=4,6m=5,dA=6,4A=7,7H=8,7I=9;1n.9E={hT:0,9C:1,dz:2,9D:3,3e:4,6m:5,dA:6,4A:7,7H:8,7I:9};1b bB={3N:1o,5g:0,1Z:1j,5h:1j};1b bC={y:1o,u:1o,v:1o,a:1o,3f:1o,3g:1o,3h:1o,3O:1o,3P:1j,hU:1j,hV:1j,7J:1j,hW:1j,hX:1j,hY:1j,7K:1j};1b bD={2q:"9E",1r:1j,1q:1j,7L:1j,u:{2r:bB,dB:bC},6n:1k,7M:1o};1f 7N(a){1g dC(a,bz)}1b bE=0,7O=1,2f=2,1L=3,7P=4,9F=5,7Q=6,3Q=7;1n.6o={5i:0,7O:1,2f:2,1L:3,7P:4,9F:5,7Q:6,3Q:7};1b bF={1r:{1i:1j},1q:{1i:1j},dD:{1i:1j},hZ:1j,i0:1j,i1:1j,dE:1j};1n.dF=1f(a,b,c){1g dG(a,b,c,bz)};1b bG={6p:1j,dH:1j,5j:1j,2B:1j,2C:1j,dI:1j,dJ:1j,5k:1j,dK:1j,dL:1j,i2:1j,i3:1j,i4:1j};1n.dM={6l:1w(bF),1P:1w(bD),dN:1w(bG)};1n.dO=1f(a){1g dP(a,bz)};1b bH={1r:1j,1q:1j,3i:1j,2D:1j,2J:1j,y:1o,u:1o,v:1o,3f:0,3g:0,3h:0,3P:1j,5l:1j,6q:7B,7R:0,6r:0,7S:0,7T:1j,9G:2i,2A:1o,7U:0,6p:1j,5j:1j,2B:1j,6s:1j,2C:1j,4B:1j,5k:1j,dK:1j,dL:1j,a:1o,3O:0};1f dQ(a){1g dR(a,bz)}1b bI={1P:1w(bD),5m:1o,5n:1o,6t:1o,6u:0,6v:0,7V:0,dS:1j,7W:1w(bG),3j:7B,6w:"(dT)",6x:"(dT)"};1b bJ={7X:1o,7Y:1k,9H:1o,4C:1j,2K:2i,5o:2i,5p:1j};1f 1A(a){1g 2L(a,1)}1f dU(a){1K(a);if(a.7Y<a.9H){1K(a.7X);1g a.7X[a.7Y++]}a.4C=1;1g 1a}1f 9I(a,b){1b c=2i;1b d=b+1<<8;if(a.5p>0){a.5o|=dU(a)<<a.5p;a.5p-=8}c=(a.5o>=d)+0;if(c){a.2K-=b+1;a.5o-=d}1l a.2K=b;1g c}1f 9J(a){1b b=bK[a.2K];a.2K=bL[a.2K];a.5o<<=b;a.5p+=b}1f 1x(a,b){1b c=a.2K*b>>8;1b d=9I(a,c);if(a.2K<1H)9J(a);1g d}1f dV(a,v){1b b=a.2K>>1;1b c=9I(a,b);9J(a);1g c?-v:v}1f 7Z(a,b,c,d){1K(a);1K(b);1K(d);a.2K=1a-1;a.7X=b;a.7Y=c;a.9H=d;a.5o=0;a.5p=8;a.4C=0}1b bK=1c 1d(7,6,6,5,5,5,5,4,4,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0);1b bL=1c 1d(1H,1H,2M,1H,3R,2M,2j,1H,3k,3R,2N,2M,5q,2j,2O,1H,4D,3k,5r,3R,4E,2N,1U,2M,4F,5q,5s,2j,4G,2O,2s,1H,3J,4D,8a,3k,9K,5r,2P,3R,3b,4E,1Q,2N,4H,1U,5t,2M,3c,4F,6y,5q,3l,5s,2g,2j,3K,4G,5u,2O,2t,2s,1C,1H,2I,3J,6z,4D,4I,8a,4J,3k,6A,9K,5v,5r,9L,2P,3m,3R,8b,3b,5w,4E,9M,1Q,6B,2N,6C,4H,6D,1U,6E,5t,6F,2M,3L,3c,5x,4F,3S,6y,1M,5q,2u,3l,2h,5s,6G,2g,2E,2j,3T,3K,9N,4G,dW,5u,dX,2O,2Q,2t,3n,2s,2k,1C,1u,1H);1f 2L(a,b){1b v=0;1y(b--\x3e0)v|=1x(a,1e)<<b;1g v}1f 2R(a,b){1b c=2L(a,b);1g 1A(a)?-c:c}1b bM=0;1b bN=1;1b bO=2;1b bP=0,9O=1,9P=2,9Q=3,dY=4,dZ=5,e0=6,e1=7,e2=8,9R=9,e3=9R+1-bP,9S=bP,9T=9P,9U=9Q,9V=9O,i5=e3,e4=4,e5=5,e6=6,i6=7;1b bQ=3,3o=4,8c=4,e7=4,e8=8,9W=4,9X=8,8d=3,8e=11,i7=19;1b bR=32;1b bS=bR*17+bR*9;1b bT=bR*17;1b bU=bR*1+8;1b bV=bU+bR*16+bR;1b bW=bV+16;1b bX={5y:1o,9Y:1o,9Z:1o,3U:2i};1b bY={4K:5b,3V:5b,e9:1o,ea:1o,a0:1o,eb:1o};1b bZ={5z:1j,5A:1j,6H:1j,6I:1v(3o,5Y),6J:1v(3o,5Y)};1b ca={4L:1v(bQ,1o),2a:9u(1c 1d(9W,9X,8d,8e),1o)};1b cb={a1:1j,6K:1j,5B:1j,8f:1j,a2:1v(8c,1j),a3:1v(8c,1j)};1b cc={a4:1j,a5:1j,5C:1j};1b cd={2S:1j,3W:1j,6L:1j};1b ce={8g:1v(2,5b),5D:1v(2,5b),8h:1v(2,5b)};1b cf={3X:1j,1D:1j,4M:1j,4N:cc,i9:bH};1b cg={6M:"6o",3Y:1j,a6:7A,6N:1w(bJ),a7:1w(bX),2T:1w(bY),3p:1w(cb),3Z:1w(bZ),ia:"ib",4a:1j,8i:1j,8j:1j,4b:cf,4O:1j,5E:1j,8k:1j,8l:1j,6O:1j,5F:1j,8m:1j,8n:9t(e8,bJ),ec:2i,6P:9t(3o,ce),2F:1w(ca),8o:1j,a8:1o,8p:1o,8q:1v(4,1o),8r:1o,8s:1o,8t:1o,4P:1w(cd),4N:1w(cc),2U:1o,2a:7C,3q:1o,3r:1o,4c:1o,3s:1j,3t:1j,4d:1j,2v:1j,2b:1j,4Q:7B,6Q:1j,1N:1j,1D:1j,4e:1o,6R:1v(16,1o),ic:0,a9:1o,6S:1o,3u:2i,4R:2i,2l:1j,4M:1j,8u:1v(3o,1o),5G:1o,aa:0,8v:5Z,ab:1o,ie:0,ed:1j,ee:1o,ig:0,8w:5Z};1f ac(a,b,c){1b d=a.ab;1b e=a.2T.4K;if(b<0||b+c>a.2T.3V)1g 1k;if(b==0){1b f=a.5G;1b g=a.aa;1b h=a.8v;1b i=e*a.2T.3V;d=ba.dy(f.6b(g,g+h))}1g b==0?d:+b*e}1b ci=1c 1d(3,4,3,4,4,2,2,1,1);1f ef(a){1b b=1;1b c=a.2q;1b d=a.1r;1b e=a.1q;if(c>=4A);1l{1b f=a.u.2r;b&=f.1Z*e<=f.5h;b&=f.1Z>=d*ci[c]}1g b?bE:2f}1f eg(a){1b w=a.1r;1b h=a.1q;if(w<=0||h<=0)1g 2f;if(!a.7L&&a.6n==1k){1b b=1o;1b c=0;1b d=a.2q;1b e=1j;1b f=0,7J=0;1b g=0;1b i=9n,7K=0,6T=9n;e=w*ci[d];i=e*h;if(d>=4A){f=4v((w+1)/2);g=f*4v((h+1)/2);if(d==7H){7J=w;7K=7J*h}}6T=i+2*g+7K;if(6T!=6T)1g 2f;a.6n=b=9s(6T,5Z);a.7M=c=0;if(b==1k)1g 7O;if(d>=4A);1l{1b j=a.u.2r;j.3N=b;j.5g=c;j.1Z=e;j.5h=i}}1g ef(a)}1f eh(w,h,a,b){if(b==1k||w<=0||h<=0)1g 2f;b.1r=w;b.1q=h;1g eg(b)}1f dC(a,b){if(b!=bz)1g 0;if(!a)1g 0;5e(a,0,0,1S(a)*a.1p);1g 1}1n.ei=1f(a){if(a){if(!a.7L)a.6n="";a.7M=0;a.6n=a.7M=1k}};1f ad(a,b){2z("ej: ad")}1f ek(a,b){2z("ej: ek")}1f em(a){1K(a);1K(a.8w>0);1g 1}1b cj=1v(1a+1a+1,1o);1b ck=1v(1a+1a+1,1o);1b cl=1v(4f+4f+1,5Y);1b cm=1v(1V+1V+1,5Y);1b cn=1v(1a+ih+1,1o);1b co=0;1f en(a){if(!co){1b i;1h(i=-1a;i<=1a;++i){cj[1a+i]=i<0?-i:i;ck[1a+i]=cj[1a+i]>>1}1h(i=-4f;i<=4f;++i)cl[4f+i]=i<-1e?-1e:i>1H?1H:i;1h(i=-1V;i<=1V;++i)cm[1V+i]=i<-16?-16:i>15?15:i;1h(i=-1a;i<=1a+1a;++i)cn[1a+i]=i<0?0:i>1a?1a:i;co=1}}1f 4S(v){1g!(v&~1a)?v:v<0?0:1a}1f ij(x,y,v){ae[eo+x+y*bR]=4S(eo+ae[x+y*bR]+(v>>3))}1b cp=ik+(1<<16);1b cq=il;1f 3v(a,b){1g a*b>>16}1f af(e,f,g,h){1b C=1v(4*4,0),2m,1W;1W=0;1b i;2m=C;1h(i=0;i<4;++i){1b a=e[f+0]+e[f+8];1b b=e[f+0]-e[f+8];1b c=3v(e[f+4],cq)-3v(e[f+12],cp);1b d=3v(e[f+4],cp)+3v(e[f+12],cq);2m[1W+0]=a+d;2m[1W+1]=b+c;2m[1W+2]=b-c;2m[1W+3]=a-d;1W+=4;f++}1W=0;1h(i=0;i<4;++i){1b j=2m[1W+0]+4;1b a=j+2m[1W+8];1b b=j-2m[1W+8];1b c=3v(2m[1W+4],cq)-3v(2m[1W+12],cp);1b d=3v(2m[1W+4],cp)+3v(2m[1W+12],cq);g[h+0+0*bR]=4S(g[h+0+0*bR]+(a+d>>3));g[h+1+0*bR]=4S(g[h+1+0*bR]+(b+c>>3));g[h+2+0*bR]=4S(g[h+2+0*bR]+(b-c>>3));g[h+3+0*bR]=4S(g[h+3+0*bR]+(a-d>>3));1W++;h+=bR}}1f ep(a,b,c,d,e){af(a,b,c,d);if(e)af(a,b+16,c,d+4)}1f eq(a,b,c,d){cu(a,b+0*16,c,d+0,1);cu(a,b+2*16,c,d+4*bR,1)}1f 5H(a,b,c,d){1b e=a[b+0]+4;1b i,j;1h(j=0;j<4;++j)1h(i=0;i<4;++i){1b f=c[d+i+j*bR];c[d+i+j*bR]=4S(c[d+i+j*bR]+(e>>3))}}1f er(a,b,c,d){if(a[b+0*16])5H(a,b+0*16,c,d+0);if(a[b+1*16])5H(a,b+1*16,c,d+4);if(a[b+2*16])5H(a,b+2*16,c,d+4*bR);if(a[b+3*16])5H(a,b+3*16,c,d+4*bR+4)}1f es(a,b){1b c=1v(16,1j);1b i=1j;1h(i=0;i<4;++i){1b d=a[0+i]+a[12+i];1b e=a[4+i]+a[8+i];1b f=a[4+i]-a[8+i];1b g=a[0+i]-a[12+i];c[0+i]=d+e;c[8+i]=d-e;c[4+i]=g+f;c[12+i]=g-f}1h(i=0;i<4;++i){1b h=b[b.1p-1];1b j=c[0+i*4]+3;1b d=j+c[3+i*4];1b e=c[1+i*4]+c[2+i*4];1b f=c[1+i*4]-c[2+i*4];1b g=j-c[3+i*4];b[h+0]=d+e>>3;b[h+16]=g+f>>3;b[h+32]=d-e>>3;b[h+48]=g-f>>3;b[b.1p-1]+=64}}1f et(a,b){es(a,b)}1f io(x,y){ae[x+y*bR]}1f 8x(a,b,c){1b d=a;1b e=b-bR;1b f=cn;1b g=+1a-d[e-1];1b y;1h(y=0;y<c;++y){1b h=f;1b i=g+a[b-1];1b x;1h(x=0;x<c;++x)a[b+x]=h[i+d[e+x]];b+=bR}}1f eu(a,b){8x(a,b,4)}1f ev(a,b){8x(a,b,8)}1f ew(a,b){8x(a,b,16)}1f ex(a,b){1b j;1h(j=0;j<16;++j)1G(a,b+j*bR,a,b-bR,16)}1f ey(a,b){1b j;1h(j=16;j>0;--j){5e(a,b+0,a[b-1],16);b+=bR}}1f 6U(v,a,b){1b j;1h(j=0;j<16;++j)1h(i=0;i<16;++i)a[b+j*bR+i]=v}1f ez(a,b){1b c=16;1b j;1h(j=0;j<16;++j)c+=a[b-1+j*bR]+a[b+j-bR];6U(c>>5,a,b)}1f eA(a,b){1b c=8;1b j;1h(j=0;j<16;++j)c+=a[b-1+j*bR];6U(c>>4,a,b)}1f eB(a,b){1b c=8;1b i;1h(i=0;i<16;++i)c+=a[b+i-bR];6U(c>>4,a,b)}1f eC(a,b){6U(1e,a,b)}1f 1s(a,b,c){1g a+2*b+c+2>>2}1f 1X(a,b){1g a+b+1>>1}1f eD(a,b){1b c=a;1b d=b-bR;1b e=1c 1d;e.1t(1s(c[d-1],c[d+0],c[d+1]));e.1t(1s(c[d+0],c[d+1],c[d+2]));e.1t(1s(c[d+1],c[d+2],c[d+3]));e.1t(1s(c[d+2],c[d+3],c[d+4]));1b i;1h(i=0;i<4;++i)1G(a,b+i*bR,e,0,4*1S(e))}1f eE(a,b){1b A=a[b-1-bR];1b B=a[b-1];1b C=a[b-1+bR];1b D=a[b-1+2*bR];1b E=a[b-1+3*bR];a[b+0+0*bR]=a[b+1+0*bR]=a[b+2+0*bR]=a[b+3+0*bR]=1s(A,B,C);a[b+0+1*bR]=a[b+1+1*bR]=a[b+2+1*bR]=a[b+3+1*bR]=1s(B,C,D);a[b+0+2*bR]=a[b+1+2*bR]=a[b+2+2*bR]=a[b+3+2*bR]=1s(C,D,E);a[b+0+3*bR]=a[b+1+3*bR]=a[b+2+3*bR]=a[b+3+3*bR]=1s(D,E,E)}1f eF(a,b){1b c=4;1b i;1h(i=0;i<4;++i)c+=a[b+i-bR]+a[b-1+i*bR];c>>=3;1h(i=0;i<4;++i)5e(a,b+i*bR,c,4)}1f eG(a,b){1b I=a[b-1+0*bR];1b J=a[b-1+1*bR];1b K=a[b-1+2*bR];1b L=a[b-1+3*bR];1b X=a[b-1-bR];1b A=a[b+0-bR];1b B=a[b+1-bR];1b C=a[b+2-bR];1b D=a[b+3-bR];a[b+0+3*bR]=1s(J,K,L);a[b+0+2*bR]=a[b+1+3*bR]=1s(I,J,K);a[b+0+1*bR]=a[b+1+2*bR]=a[b+2+3*bR]=1s(X,I,J);a[b+0+0*bR]=a[b+1+1*bR]=a[b+2+2*bR]=a[b+3+3*bR]=1s(A,X,I);a[b+1+0*bR]=a[b+2+1*bR]=a[b+3+2*bR]=1s(B,A,X);a[b+2+0*bR]=a[b+3+1*bR]=1s(C,B,A);a[b+3+0*bR]=1s(D,C,B)}1f eH(a,b){1b A=a[b+0-bR];1b B=a[b+1-bR];1b C=a[b+2-bR];1b D=a[b+3-bR];1b E=a[b+4-bR];1b F=a[b+5-bR];1b G=a[b+6-bR];1b H=a[b+7-bR];a[b+0+0*bR]=1s(A,B,C);a[b+1+0*bR]=a[b+0+1*bR]=1s(B,C,D);a[b+2+0*bR]=a[b+1+1*bR]=a[b+0+2*bR]=1s(C,D,E);a[b+3+0*bR]=a[b+2+1*bR]=a[b+1+2*bR]=a[b+0+3*bR]=1s(D,E,F);a[b+3+1*bR]=a[b+2+2*bR]=a[b+1+3*bR]=1s(E,F,G);a[b+3+2*bR]=a[b+2+3*bR]=1s(F,G,H);a[b+3+3*bR]=1s(G,H,H)}1f eI(a,b){1b I=a[b-1+0*bR];1b J=a[b-1+1*bR];1b K=a[b-1+2*bR];1b X=a[b-1-bR];1b A=a[b+0-bR];1b B=a[b+1-bR];1b C=a[b+2-bR];1b D=a[b+3-bR];a[b+0+0*bR]=a[b+1+2*bR]=1X(X,A);a[b+1+0*bR]=a[b+2+2*bR]=1X(A,B);a[b+2+0*bR]=a[b+3+2*bR]=1X(B,C);a[b+3+0*bR]=1X(C,D);a[b+0+3*bR]=1s(K,J,I);a[b+0+2*bR]=1s(J,I,X);a[b+0+1*bR]=a[b+1+3*bR]=1s(I,X,A);a[b+1+1*bR]=a[b+2+3*bR]=1s(X,A,B);a[b+2+1*bR]=a[b+3+3*bR]=1s(A,B,C);a[b+3+1*bR]=1s(B,C,D)}1f eJ(a,b){1b A=a[b+0-bR];1b B=a[b+1-bR];1b C=a[b+2-bR];1b D=a[b+3-bR];1b E=a[b+4-bR];1b F=a[b+5-bR];1b G=a[b+6-bR];1b H=a[b+7-bR];a[b+0+0*bR]=1X(A,B);a[b+1+0*bR]=a[b+0+2*bR]=1X(B,C);a[b+2+0*bR]=a[b+1+2*bR]=1X(C,D);a[b+3+0*bR]=a[b+2+2*bR]=1X(D,E);a[b+0+1*bR]=1s(A,B,C);a[b+1+1*bR]=a[b+0+3*bR]=1s(B,C,D);a[b+2+1*bR]=a[b+1+3*bR]=1s(C,D,E);a[b+3+1*bR]=a[b+2+3*bR]=1s(D,E,F);a[b+3+2*bR]=1s(E,F,G);a[b+3+3*bR]=1s(F,G,H)}1f eK(a,b){1b I=a[b-1+0*bR];1b J=a[b-1+1*bR];1b K=a[b-1+2*bR];1b L=a[b-1+3*bR];a[b+0+0*bR]=1X(I,J);a[b+2+0*bR]=a[b+0+1*bR]=1X(J,K);a[b+2+1*bR]=a[b+0+2*bR]=1X(K,L);a[b+1+0*bR]=1s(I,J,K);a[b+3+0*bR]=a[b+1+1*bR]=1s(J,K,L);a[b+3+1*bR]=a[b+1+2*bR]=1s(K,L,L);a[b+3+2*bR]=a[b+2+2*bR]=a[b+0+3*bR]=a[b+1+3*bR]=a[b+2+3*bR]=a[b+3+3*bR]=L}1f eL(a,b){1b I=a[b-1+0*bR];1b J=a[b-1+1*bR];1b K=a[b-1+2*bR];1b L=a[b-1+3*bR];1b X=a[b-1-bR];1b A=a[b+0-bR];1b B=a[b+1-bR];1b C=a[b+2-bR];a[b+0+0*bR]=a[b+2+1*bR]=1X(I,X);a[b+0+1*bR]=a[b+2+2*bR]=1X(J,I);a[b+0+2*bR]=a[b+2+3*bR]=1X(K,J);a[b+0+3*bR]=1X(L,K);a[b+3+0*bR]=1s(A,B,C);a[b+2+0*bR]=1s(X,A,B);a[b+1+0*bR]=a[b+3+1*bR]=1s(I,X,A);a[b+1+1*bR]=a[b+3+2*bR]=1s(J,I,X);a[b+1+2*bR]=a[b+3+3*bR]=1s(K,J,I);a[b+1+3*bR]=1s(L,K,J)}1f eM(a,b){1b j;1h(j=0;j<8;++j)1G(a,b+j*bR,a,b-bR,8)}1f eN(a,b){1b j;1h(j=0;j<8;++j){5e(a,b+0,a[b-1],8);b+=bR}}1f 6V(v,a,b){1b j,k;1h(j=0;j<8;++j)1h(k=0;k<8;++k)a[b+k+j*bR]=v}1f eO(a,b){1b c=8;1b i;1h(i=0;i<8;++i)c+=a[b+i-bR]+a[b-1+i*bR];6V((c>>4)*1,a,b)}1f eP(a,b){1b c=4;1b i;1h(i=0;i<8;++i)c+=a[b+i-bR];6V((c>>3)*1,a,b)}1f eQ(a,b){1b c=4;1b i;1h(i=0;i<8;++i)c+=a[b-1+i*bR];6V((c>>3)*1,a,b)}1f eR(a,b){6V(1e,a,b)}1b cr=1c 1d(1f(v,o){eF(v,o)},1f(v,o){eu(v,o)},1f(v,o){eD(v,o)},1f(v,o){eE(v,o)},1f(v,o){eG(v,o)},1f(v,o){eI(v,o)},1f(v,o){eH(v,o)},1f(v,o){eJ(v,o)},1f(v,o){eL(v,o)},1f(v,o){eK(v,o)});1b cs=1c 1d(1f(v,o){ez(v,o)},1f(v,o){ew(v,o)},1f(v,o){ex(v,o)},1f(v,o){ey(v,o)},1f(v,o){eA(v,o)},1f(v,o){eB(v,o)},1f(v,o){eC(v,o)});1b ct=1c 1d(1f(v,o){eO(v,o)},1f(v,o){ev(v,o)},1f(v,o){eM(v,o)},1f(v,o){eN(v,o)},1f(v,o){eQ(v,o)},1f(v,o){eP(v,o)},1f(v,o){eR(v,o)});1f 6W(p,b,c){1b d=p[b-2*c],1Y=p[b-c],2V=p[b+0],2c=p[b+c];1b a=3*(2V-1Y)+cl[4f+d-2c];1b e=cm[1V+(a+4>>3)];1b f=cm[1V+(a+3>>3)];p[b-c]=cn[1a+1Y+f];p[b+0]=cn[1a+2V-e]}1f eS(p,b,c){1b d=p[b-2*c],1Y=p[b-c],2V=p[b+0],2c=p[b+c];1b a=3*(2V-1Y);1b e=cm[1V+(a+4>>3)];1b f=cm[1V+(a+3>>3)];1b g=e+1>>1;p[b-2*c]=cn[1a+d+g];p[b-c]=cn[1a+1Y+f];p[b+0]=cn[1a+2V-e];p[b+c]=cn[1a+2c-g]}1f eT(p,b,c){1b d=p[b-3*c],4T=p[b-2*c],1Y=p[b-c];1b e=p[b+0],2c=p[b+c],6X=p[b+2*c];1b a=cl[4f+3*(e-1Y)+cl[4f+4T-2c]];1b f=27*a+63>>7;1b g=18*a+63>>7;1b h=9*a+63>>7;p[b-3*c]=cn[1a+d+h];p[b-2*c]=cn[1a+4T+g];p[b-c]=cn[1a+1Y+f];p[b+0]=cn[1a+e-f];p[b+c]=cn[1a+2c-g];p[b+2*c]=cn[1a+6X-h]}1f ag(p,a,b,c){1b d=p[a-2*b],1Y=p[a-b],2V=p[a+0],2c=p[a+b];1g cj[1a+d-1Y]>c||cj[1a+2c-2V]>c}1f ah(p,a,b,c){1b d=p[a-2*b],1Y=p[a-b],2V=p[a+0],2c=p[a+b];1g 2*cj[1a+1Y-2V]+ck[1a+d-2c]<=c}1f ai(p,a,b,t,c){1b d=p[a-4*b],aj=p[a-3*b],4T=p[a-2*b],1Y=p[a-b];1b e=p[a+0],2c=p[a+b],6X=p[a+2*b],eU=p[a+3*b];if(2*cj[1a+1Y-e]+ck[1a+4T-2c]>t)1g 0;1g cj[1a+d-aj]<=c&&cj[1a+aj-4T]<=c&&cj[1a+4T-1Y]<=c&&cj[1a+eU-6X]<=c&&cj[1a+6X-2c]<=c&&cj[1a+2c-e]<=c}1f ak(p,a,b,c){1b i;1h(i=0;i<16;++i)if(ah(p,a+i,b,c))6W(p,a+i,b)}1f al(p,a,b,c){1b i;1h(i=0;i<16;++i)if(ah(p,a+i*b,1,c))6W(p,a+i*b,1)}1f eV(p,a,b,c){1b k;1h(k=3;k>0;--k){a+=4*b;ak(p,a+0,b,c)}}1f eW(p,a,b,c){1b k;1h(k=3;k>0;--k){a+=4;al(p,a+0,b,c)}}1f 4U(p,a,b,c,d,e,f,g){1y(d--\x3e0){if(ai(p,a+0,b,e,f))if(ag(p,a+0,b,g))6W(p,a+0,b);1l eT(p,a+0,b);a+=c}}1f 4V(p,a,b,c,d,e,f,g){1y(d--\x3e0){if(ai(p,a+0,b,e,f))if(ag(p,a+0,b,g))6W(p,a+0,b);1l eS(p,a+0,b);a+=c}}1f eX(p,a,b,c,d,e){4U(p,a+0,b,1,16,c,d,e)}1f eY(p,a,b,c,d,e){4U(p,a+0,1,b,16,c,d,e)}1f eZ(p,a,b,c,d,e){1b k;1h(k=3;k>0;--k){a+=4*b;4V(p,a+0,b,1,16,c,d,e)}}1f f0(p,a,b,c,d,e){1b k;1h(k=3;k>0;--k){a+=4;4V(p,a+0,1,b,16,c,d,e)}}1f f1(u,a,v,b,c,d,e,f){4U(u,a,c,1,8,d,e,f);4U(v,b,c,1,8,d,e,f)}1f f2(u,a,v,b,c,d,e,f){4U(u,a,1,c,8,d,e,f);4U(v,b,1,c,8,d,e,f)}1f f3(u,a,v,b,c,d,e,f){4V(u,a+4*c,c,1,8,d,e,f);4V(v,b+4*c,c,1,8,d,e,f)}1f f4(u,a,v,b,c,d,e,f){4V(u,a+4,1,c,8,d,e,f);4V(v,b+4,1,c,8,d,e,f)}1b cu;1b cv;1b cw;1b cx;1b cy;1b cz;1b cA;1b cB;1b cC;1b cD;1b cE;1b cF;1b cG;1b cH;1b cI;1b cJ;1f f5(a){cu=ep;cv=eq;cw=5H;cx=er;cy=eX;cz=eY;cA=f1;cB=f2;cC=eZ;cD=f0;cE=f3;cF=f4;cG=ak;cH=al;cI=eV;cJ=eW}1b cK=32-1;1b cL=3;1b cM=1;1f f6(a){a.8i=0;if(a.4a);1l a.8j=cM;1g 1}1b cN=1c 1d(0,2,8);1f f7(a){1b b=a.8j;1b c=a.4O;1b d=4*c*1S(1o);1b e=(16+8+8)*c;1b f=(c+1)*1S(cd);1b g=a.2l>0?c*(a.4a?2:1)*1S(cc):0;1b h=bS*1S(a.2U);1b i=f8*1S(a.2a);1b j=16*b+4v(cN[a.2l])*3/2;1b k=e*j;1b l=a.5G?a.2T.4K*a.2T.3V:0;1b m=d+e+f+g+h+i+k+l+cK;1b n=1o,ip=0;if(m>a.6Q){a.4Q=0;a.6Q=0;if(a.4Q==1k)1g 1z(a,"7O","iq 3j ir am it.");a.6Q=m}n=a.4Q;a.8p=1M;a.8r=4w(1M,16*c*1S(a.8r));a.8s=4w(1M,8*c*1S(a.8s));a.8t=4w(1M,8*c*1S(a.8t));a.4N=g?9r(cc,g):1k;a.iu=g?0:1k;a.4b.3X=0;a.4b.4N=a.4N;if(a.4a);1K((h&cK)==0);a.2U=4w(1M,h*1S(a.2U));a.2a=-iv;a.2v=16*c;a.2b=8*c;1b o=cN[a.2l];1b p=o*a.2v;1b q=o/2*a.2b;a.3q=1v(k,1M);a.3s=+p;a.3r=a.3q;a.3t=a.3s+16*b*a.2v+q;a.4c=a.3r;a.4d=a.3t+8*b*a.2b+q;a.ab=l?1v(l,1o):1k;a.4P=9r(cd,f);a.8p=4w(bP,d);1g 1}1f f9(a,b){b.1r=a.2T.4K;b.1q=a.2T.3V;b.3i=0;b.y=a.3q;b.3f=a.3s;b.u=a.3r;b.3g=a.3t;b.v=a.4c;b.3h=a.4d;b.3P=a.2v;b.5l=a.2b;b.7T=0;b.a=1k;b.3O=1k}1f fa(a,b){if(!f6(a))1g 0;if(!f7(a))1g 0;f9(a,b);en();f5();1g 1}1f fb(a,b){if(b)1g a>=40?2:a>=15?1:0;1l 1g a>=40?3:a>=20?2:a>=15?1:0}1f fc(a,b,c){1b d=a.4b;1b e=a.2v;1b f=d.4N[1+b];1b g=a.3q;1b h=a.3s+d.3X*16*e+b*16;1b i=f.a4;1b j=f.a5;1b k=2*i+j;if(i==0)1g;if(a.2l==1){if(b>0)cH(g,h,e,k+4);if(f.5C)cJ(g,h,e,k);if(c>0)cG(g,h,e,k+4);if(f.5C)cI(g,h,e,k)}1l{1b l=a.2b;1b m=a.3r;1b n=a.3t+d.3X*8*l+b*8;1b o=a.4c;1b p=a.4d+d.3X*8*l+b*8;1b q=fb(i,a.a7.5y);if(b>0){cz(g,h,e,k+4,j,q);cB(m,n,o,p,l,k+4,j,q)}if(f.5C){cD(g,h,e,k,j,q);cF(m,n,o,p,l,k,j,q)}if(c>0){cy(g,h,e,k+4,j,q);cA(m,n,o,p,l,k+4,j,q)}if(f.5C){cC(g,h,e,k,j,q);cE(m,n,o,p,l,k,j,q)}}}1f fd(a){1b b=1j;1b c=a.4b.1D;1K(a.4b.4M);1h(b=a.8k;b<a.6O;++b)fc(a,b,c)}1f fe(a){if(a.2l>0){1b b=a.4N[1+a.1N];1b c=a.4P[1+a.1N].6L;1b d=a.8u[a.6S];if(a.3p.8f){d+=a.3p.a2[0];if(a.4e)d+=a.3p.a3[0]}d=d<0?0:d>63?63:d;b.a4=d;if(a.3p.5B>0){if(a.3p.5B>4)d>>=2;1l d>>=1;if(d>9-a.3p.5B)d=9-a.3p.5B}b.a5=d<1?1:d;b.5C=(!c||a.4e)+0}1b y;1b e=a.8i*16*a.2v;1b f=a.8i*8*a.2b;1b g=a.3q;1b h=a.3s+a.1N*16+e;1b i=a.3r;1b j=a.3t+a.1N*8+f;1b k=a.4c;1b l=a.4d+a.1N*8+f;1h(y=0;y<16;++y)1G(g,h+y*a.2v,a.2U,+bU+y*bR,16);1h(y=0;y<8;++y){1G(i,j+y*a.2b,a.2U,+bV+y*bR,8);1G(k,l+y*a.2b,a.2U,+bW+y*bR,8)}}1f an(a){1g a*16}1f ff(a,b){1b c=1;1b d=a.4b;1b e=cN[a.2l];1b f=e*a.2v;1b g=4v(e/2)*a.2b;1b h=d.3X*16*a.2v;1b i=d.3X*8*a.2b;1b j=a.3q;1b k=a.3s-f+h;1b l=a.3r;1b m=a.3t-g+i;1b n=a.4c;1b o=a.4d-g+i;1b p=d.1D==0;1b q=(d.1D>=a.5E-1)+0;1b r=an(d.1D);1b s=an(d.1D+1);if(d.4M)fd(a);if(b.7R){if(!p){r-=e;b.y=j;b.3f=k;b.u=l;b.3g=m;b.v=n;b.3h=o}1l{b.y=a.3q;b.3f=a.3s+h;b.u=a.3r;b.3g=a.3t+i;b.v=a.4c;b.3h=a.4d+i}if(!q)s-=e;if(s>b.4B)s=b.4B;if(a.5G){if(r==0){b.a=ac(a,r,s-r);b.3O=0}1l b.3O=ac(a,r,s-r);if(b.a==1k)1g 1z(a,1L,"iw fg ix iy 2A.")}if(r<b.2C){1b t=b.2C-r;r=b.2C;1K(!(t&1));b.3f+=a.2v*t;b.3g+=a.2b*(t>>1);b.3h+=a.2b*(t>>1);if(b.a)b.3O+=b.1r*t}if(r<s){b.3f+=b.2B;b.3g+=b.2B>>1;b.3h+=b.2B>>1;if(b.a)b.3O+=b.2B;b.3i=r-b.2C;b.2D=b.6s-b.2B;b.2J=s-r;c=b.7R(b)}}if(d.3X+1==a.8j)if(!q){1G(a.3q,a.3s-f,j,k+16*a.2v,f);1G(a.3r,a.3t-g,l,m+8*a.2b,g);1G(a.4c,a.4d-g,n,o+8*a.2b,g)}1g c}1f fh(a,b){1b c=1;1b d=a.4b;if(!a.4a){d.1D=a.1D;d.4M=a.4M;c=ff(a,b)}1g c}1f fi(a,b){if(b.6r&&!b.6r(b)){1z(a,7Q,"fj 6r iz");1g a.6M}if(b.6p)a.2l=0;1b c=cN[a.2l];if(a.2l==2){a.8k=0;a.8l=0}1l{a.8l=b.2C>>4;a.8k=b.2B>>4}a.5F=b.4B+15+c>>4;a.6O=b.6s+15+c>>4;if(a.6O>a.4O)a.6O=a.4O;if(a.5F>a.5E)a.5F=a.5E;1g bE}1f fk(a,b){1b c=1;if(a.4a);if(b.7S)b.7S(b);1g c}1b cO=1c 1d(0+0*bR,4+0*bR,8+0*bR,12+0*bR,0+4*bR,4+4*bR,8+4*bR,12+4*bR,0+8*bR,4+8*bR,8+8*bR,12+8*bR,0+12*bR,4+12*bR,8+12*bR,12+12*bR);1f ao(a,b){if(b==bP)if(a.1N==0)1g a.1D==0?e6:e5;1l 1g a.1D==0?e4:bP;1g b}1f 8y(a,b,c,d){1h(i=0;i<4;++i)a[b+i]=c[d+i]}1f fl(a){1b b=a.2U;1b c=bU;1b d=a.2U;1b e=bV;1b f=a.2U;1b g=bW;if(a.1N>0){1b j;1h(j=-1;j<16;++j)8y(b,c+j*bR-4,b,c+j*bR+12);1h(j=-1;j<8;++j){8y(d,e+j*bR-4,d,e+j*bR+4);8y(f,g+j*bR-4,f,g+j*bR+4)}}1l{1b j;1h(j=0;j<16;++j)b[c+j*bR-1]=2I;1h(j=0;j<8;++j){d[e+j*bR-1]=2I;f[g+j*bR-1]=2I}if(a.1D>0)b[c-1-bR]=d[e-1-bR]=f[g-1-bR]=2I}1b h=a.8r;1b k=+a.1N*16;1b l=a.8s;1b m=+a.1N*8;1b o=a.8t;1b p=+a.1N*8;1b q=a.2a;1b n;if(a.1D>0){1G(b,c-bR,h,k,16);1G(d,e-bR,l,m,8);1G(f,g-bR,o,p,8)}1l if(a.1N==0){1h(i=0;i<16+4+1;++i)b[c-bR-1+i]=1H;1h(i=0;i<8+1;++i)d[e-bR-1+i]=1H;1h(i=0;i<8+1;++i)f[g-bR-1+i]=1H}if(a.4e){1b r=b;1b s=c-bR+16;if(a.1D>0)if(a.1N>=a.4O-1)r[s+0]=r[s+1]=r[s+2]=r[s+3]=h[k+15];1l 1G(r,s+0,h,k+16,4);1h(ii=0;ii<4;++ii)r[ii+s+bR*4]=r[ii+s+1*bR*4]=r[ii+s+2*bR*4]=r[ii+s+3*bR*4]=r[ii+s+0*4];1h(n=0;n<16;n++){1b t=b;1b u=c+cO[n];cr[a.6R[n]](t,u);if(a.4R&1<<n)cu(q,+n*16,t,u,0);1l if(a.3u&1<<n)cw(q,+n*16,t,u)}}1l{1b v=ao(a,a.6R[0]);cs[v](b,c);if(a.3u)1h(n=0;n<16;n++){1b t=b;1b u=c+cO[n];if(a.4R&1<<n)cu(q,+n*16,t,u,0);1l if(a.3u&1<<n)cw(q,+n*16,t,u)}}1b v=ao(a,a.a9);ct[v](d,e);ct[v](f,g);if(a.3u&fm){1b w=a.2a;1b x=16*16;if(a.4R&fm)cv(w,x,d,e);1l cx(w,x,d,e)}if(a.3u&fn){1b y=a.2a;1b x=20*16;if(a.4R&fn)cv(y,x,f,g);1l cx(y,x,f,g)}if(a.1D<a.5E-1){1G(h,k,b,c+15*bR,16);1G(l,m,d,e+7*bR,8);1G(o,p,f,g+7*bR,8)}}1f 2W(v,M){1g v<0?0:v>M?M:v}1b cP=1c 1d(4,5,6,7,8,9,10,10,11,12,13,14,15,16,17,17,18,19,20,20,21,21,22,22,23,23,24,25,25,26,27,28,29,30,31,32,33,34,35,36,37,37,38,39,40,41,42,43,44,45,46,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,76,77,78,79,80,81,82,83,84,85,86,87,88,89,91,93,95,96,98,1I,3w,1R,5I,6Y,ap,6Z,1V,2w,3x,7a,fo,5J,5K,1e,4W,8z,4X,7b,4g,5L,3k,6A,7c,5r,3y,3m);1b cQ=1c 1d(4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,60,62,64,66,68,70,72,74,76,78,80,82,84,86,88,90,92,94,96,98,1I,1R,5I,6Y,ap,6Z,1V,2w,3x,8A,fo,fp,1e,3J,4X,4I,5L,3k,4h,5v,5M,2P,fq,8b,aq,4E,4i,6B,6C,6D,6E,6F,3L,5x,3S,1M,2u,2h,6G,2E,3T,9N,2x,2O,3n,2k,1m,iA,iB,iC,iD,iE,iF);1f fr(a){1b b=a.6N;1b c=2L(b,7);1b d=1A(b)?2R(b,4):0;1b e=1A(b)?2R(b,4):0;1b f=1A(b)?2R(b,4):0;1b g=1A(b)?2R(b,4):0;1b h=1A(b)?2R(b,4):0;1b j=a.3Z;1b i=1j;1h(i=0;i<3o;++i){1b q=1j;if(j.5z){q=j.6I[i];if(!j.6H)q+=c}1l if(i>0){a.6P[i]=a.6P[0];d5}1l q=c;1b m=a.6P[i];m.8g[0]=cP[2W(q+d,1H)];m.8g[1]=cQ[2W(q+0,1H)];m.5D[0]=cP[2W(q+e,1H)]*2;m.5D[1]=4v(cQ[2W(q+f,1H)]*2P/1I);if(m.5D[1]<8)m.5D[1]=8;m.8h[0]=cP[2W(q+g,7d)];m.8h[1]=cQ[2W(q+h,1H)]}}1b cR=1c 1d(-bP,1,-9O,2,-9P,3,4,6,-9Q,5,-dY,-dZ,-e0,7,-e1,8,-e2,-9R);1b cS=1c 1d(1c 1d(1c 1d(1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1u,7b,1m,1a,5N,2g,1e,1e,1e,1e,1e),1c 1d(6F,2I,7e,1a,3K,2h,1a,2g,1e,1e,1e),1c 1d(6Y,5K,3K,1O,ar,2u,1a,1a,1e,1e,1e)),1c 1d(1c 1d(1,98,2n,1a,2X,5O,1a,1a,1e,1e,1e),1c 1d(6D,6z,8B,1m,2E,2x,1a,3y,1e,1e,1e),1c 1d(78,4X,7f,2s,5P,7g,1a,2g,1e,1e,1e)),1c 1d(1c 1d(1,6E,2k,1a,2t,1a,1e,1e,1e,1e,1e),1c 1d(7h,at,2s,1a,2X,4j,1e,1e,1e,1e,1e),1c 1d(77,6Z,8C,1a,2X,7i,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,3w,1C,1a,2Q,1a,1e,1e,1e,1e,1e),1c 1d(4i,8a,2Q,1O,2X,2u,1a,1a,1e,1e,1e),1c 1d(37,3x,4k,2t,5N,1a,1a,1a,1e,1e,1e)),1c 1d(1c 1d(1,fs,1m,1a,3n,1a,1e,1e,1e,1e,1e),1c 1d(5q,4l,2o,1a,8B,1e,1e,1e,1e,1e,1e),1c 1d(1R,au,4G,1a,3l,1Q,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,5M,1O,1a,3z,1a,1e,1e,1e,1e,1e),1c 1d(6C,4D,2t,1a,2x,3T,1e,1e,1e,1e,1e),1c 1d(80,2I,3l,1a,av,4j,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,1,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(4m,1,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(1a,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e))),1c 1d(1c 1d(1c 1d(5P,35,dX,2j,3L,5t,8D,4l,6A,2P,62),1c 1d(3J,45,5P,2E,aw,5Q,7j,3m,1O,2E,1),1c 1d(68,47,4h,ax,5v,4E,2E,8D,1a,2j,1e)),1c 1d(1c 1d(1,5v,2Q,1a,2E,4j,1a,1a,1e,1e,1e),1c 1d(7h,4J,2x,1u,8E,7j,1a,4F,1e,1e,1e),1c 1d(81,99,6D,7e,5Q,7k,2k,7f,1a,1a,1e)),1c 1d(1c 1d(1,2I,7l,1u,ar,5x,7e,4k,1a,1a,1e),1c 1d(99,5R,ft,2o,3S,5P,1a,7f,1e,1e,1e),1c 1d(23,91,3b,7e,4i,5t,2s,ft,1a,1a,1e)),1c 1d(1c 1d(1,ay,4m,1a,2x,1a,1e,1e,1e,1e,1e),1c 1d(az,8F,2Q,1a,4G,3n,1a,1a,1e,1e,1e),1c 1d(44,4W,3S,1u,1M,2G,1a,1a,1e,1e,1e)),1c 1d(1c 1d(1,8z,2O,1C,2g,2u,1a,5w,1e,1e,1e),1c 1d(94,7b,3T,1C,5S,7k,1a,1a,1e,1e,1e),1c 1d(22,1I,8G,3n,5T,8b,1a,4F,1e,1e,1e)),1c 1d(1c 1d(1,5U,2k,1a,7l,5u,1e,1e,1e,1e,1e),1c 1d(5J,3k,2Q,1a,3K,2x,1e,1e,1e,1e,1e),1c 1d(35,77,6D,1C,3L,3l,1a,1M,1e,1e,1e)),1c 1d(1c 1d(1,3m,2s,1a,2X,4G,1a,1a,1e,1e,1e),1c 1d(5R,4J,5u,1a,3T,3K,1a,1a,1e,1e,1e),1c 1d(45,99,7m,1C,3c,6G,1a,4j,1e,1e,1e)),1c 1d(1c 1d(1,1,1C,1a,2h,1a,1e,1e,1e,1e,1e),1c 1d(6y,1,2n,1a,1a,1e,1e,1e,1e,1e,1e),1c 1d(4I,1,6C,1a,4j,1a,1e,1e,1e,1e,1e))),1c 1d(1c 1d(1c 1d(1u,9,2n,1C,5q,ax,1a,2G,1e,1e,1e),1c 1d(2N,13,4j,2t,3L,6E,2k,5P,1a,1a,1e),1c 1d(73,17,1Q,2E,8b,4H,2X,4E,1a,2x,1e)),1c 1d(1c 1d(1,95,2s,1u,aA,1U,1a,1a,1e,1e,1e),1c 1d(2O,90,8H,2o,3l,2u,1a,1a,1e,1e,1e),1c 1d(2P,77,3c,2n,7m,3c,1a,1a,1e,1e,1e)),1c 1d(1c 1d(1,24,2O,1C,5S,2g,1a,1M,1e,1e,1e),1c 1d(3S,51,2g,1a,4k,5T,1e,1e,1e,1e,1e),1c 1d(69,46,7k,2O,3S,5S,1a,5N,1e,1e,1e)),1c 1d(1c 1d(1,2M,1C,1a,1a,1e,1e,1e,1e,1e,1e),1c 1d(2j,5w,2k,1a,2h,1a,1e,1e,1e,1e,1e),1c 1d(4J,5J,2n,1a,1a,1e,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,16,2n,1a,1a,1e,1e,1e,1e,1e,1e),1c 1d(7k,36,7i,1a,2X,1a,1e,1e,1e,1e,1e),1c 1d(5v,1,1a,1e,1e,1e,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,5O,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(2s,2G,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(3z,1e,1a,1e,1e,1e,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1,4X,1O,1a,1a,1e,1e,1e,1e,1e,1e),1c 1d(2h,62,2o,1a,1a,1e,1e,1e,1e,1e,1e),1c 1d(55,93,1a,1e,1e,1e,1e,1e,1e,1e,1e)),1c 1d(1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(1e,1e,1e,1e,1e,1e,1e,1e,1e,1e,1e))),1c 1d(1c 1d(1c 1d(7f,24,2h,5u,5T,2M,7j,4l,3z,2N,1a),1c 1d(5K,38,5U,7l,9M,7h,5N,8G,1a,5t,1e),1c 1d(61,46,4g,2g,5r,8F,3z,4i,1a,8C,1e)),1c 1d(1c 1d(1,1V,7i,2o,4F,2M,2s,3R,1a,1a,1e),1c 1d(4n,az,5N,1O,3l,5s,1a,8G,1e,1e,1e),1c 1d(39,77,8D,7l,aw,7g,3n,8F,1a,1a,1e)),1c 1d(1c 1d(1,52,7j,4m,5P,4F,2k,7j,1a,1a,1e),1c 1d(5J,74,2M,2t,1U,3L,2o,2E,1a,1a,1e),1c 1d(24,71,4W,2g,3y,4i,2t,5U,1a,1a,1e)),1c 1d(1c 1d(1,5U,3T,2k,2g,3z,1a,4j,1e,1e,1e),1c 1d(5v,at,5O,1O,8C,1M,1a,1Q,1e,1e,1e),1c 1d(28,ap,4i,7e,1U,av,1m,2j,1a,1a,1e)),1c 1d(1c 1d(1,81,7i,1O,fs,6y,1a,2G,1e,1e,1e),1c 1d(aB,1R,2u,2s,7m,4k,1a,dW,1e,1e,1e),1c 1d(20,95,9L,2t,aq,6B,1a,6y,1e,1e,1e)),1c 1d(1c 1d(1,8E,2n,1a,8C,2h,1e,1e,1e,1e,1e),1c 1d(fu,2N,4m,1O,5u,1M,1a,1a,1e,1e,1e),1c 1d(47,3x,5s,1a,3l,aA,1a,1a,1e,1e,1e)),1c 1d(1c 1d(1,5R,2X,1u,aA,ar,1a,1a,1e,1e,1e),1c 1d(4J,84,2h,1O,3S,7f,1a,2g,1e,1e,1e),1c 1d(42,80,4l,3z,8D,6E,1a,1M,1e,1e,1e)),1c 1d(1c 1d(1,1,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(8H,1,1a,1e,1e,1e,1e,1e,1e,1e,1e),1c 1d(8B,1,1a,1e,1e,1e,1e,1e,1e,1e,1e))));1b cT=1c 1d(1c 1d(1c 1d(4G,6k,48,89,3I,aC,6k,5M,1V),1c 1d(5M,4H,64,5K,4i,7a,46,70,95),1c 1d(2N,69,3k,80,85,82,72,2P,au),1c 1d(56,58,10,1Q,5S,6F,17,13,5M),1c 1d(2w,26,17,3b,44,3c,21,10,6B),1c 1d(5R,24,80,3c,26,62,44,64,85),1c 1d(7G,71,10,38,1Q,2h,7G,34,26),1c 1d(4i,46,55,19,7b,4l,33,fv,71),1c 1d(63,20,8,2w,2w,ax,12,9,5O),1c 1d(81,40,11,96,5U,84,29,16,36)),1c 1d(1c 1d(4X,1U,89,4I,98,3w,6Y,5w,7c),1c 1d(72,5t,1I,4W,3m,7n,32,75,80),1c 1d(66,1R,4E,99,74,62,40,2x,1e),1c 1d(41,53,9,8F,2Q,4J,26,8,fw),1c 1d(74,43,26,4h,73,4n,49,23,3m),1c 1d(65,38,iG,4l,51,52,31,3I,1e),1c 1d(5I,79,12,27,6G,1a,87,17,7),1c 1d(87,68,71,44,2w,51,15,5T,23),1c 1d(47,41,14,6Z,5U,1U,21,17,av),1c 1d(66,45,25,1R,5x,6F,23,18,22)),1c 1d(1c 1d(88,88,9K,at,42,46,45,4k,1M),1c 1d(43,97,1U,7d,85,38,35,4H,61),1c 1d(39,53,ay,87,26,21,43,7l,1Q),1c 1d(56,34,51,5I,2w,1R,29,93,77),1c 1d(39,28,85,1Q,58,5w,90,98,64),1c 1d(34,22,3x,fv,23,34,43,4n,73),1c 1d(fw,54,32,26,51,1,81,43,31),1c 1d(68,25,6Y,22,64,1Q,36,3T,2w),1c 1d(34,19,21,1R,8z,7m,16,76,5J),1c 1d(62,18,78,95,85,57,50,48,51)),1c 1d(1c 1d(3L,3w,35,3R,5s,7n,89,46,7n),1c 1d(60,7c,31,aw,2g,5N,21,18,7n),1c 1d(1V,aC,77,85,4H,1a,38,6k,2w),1c 1d(40,42,1,4k,3n,2u,10,25,az),1c 1d(88,43,29,5L,4n,2h,37,43,3y),1c 1d(61,63,30,2P,67,45,68,1,2u),1c 1d(1I,80,8,43,3y,1,51,26,71),1c 1d(8I,78,78,16,1a,1e,34,5x,1Q),1c 1d(41,40,5,1R,3l,1U,4,1,2E),1c 1d(51,50,17,fu,2u,2G,23,25,82)),1c 1d(1c 1d(4g,31,36,1Q,27,4n,38,44,9N),1c 1d(67,87,58,9M,82,3I,26,59,4H),1c 1d(63,59,90,7g,59,4n,93,73,3y),1c 1d(40,40,21,3x,3k,2u,34,39,2N),1c 1d(47,15,16,1U,34,2j,49,45,1U),1c 1d(46,17,33,1U,6,98,15,32,1U),1c 1d(57,46,22,24,1e,1,54,17,37),1c 1d(65,32,73,3I,28,1e,23,1e,1M),1c 1d(40,3,9,3I,51,2G,18,6,2j),1c 1d(87,37,9,3I,59,77,64,21,47)),1c 1d(1c 1d(5I,55,44,5S,9,54,53,4W,5O),1c 1d(64,90,70,1M,40,41,23,26,57),1c 1d(54,57,1V,7h,5,41,38,4n,2h),1c 1d(30,34,26,6z,5M,3x,10,32,4X),1c 1d(39,19,53,2E,26,2w,32,73,1a),1c 1d(31,9,65,2x,2,15,1,7a,73),1c 1d(75,32,12,51,2G,1a,4l,43,51),1c 1d(88,31,35,67,1R,85,55,5T,85),1c 1d(56,21,23,7n,59,1M,45,37,2G),1c 1d(55,38,70,5J,73,1R,1,34,98)),1c 1d(1c 1d(fp,98,42,88,5I,85,7d,2N,82),1c 1d(95,84,53,89,1e,1I,aC,3w,45),1c 1d(75,79,aB,47,51,1e,81,1Q,1),1c 1d(57,17,5,71,1R,57,53,41,49),1c 1d(38,33,13,5R,57,73,26,1,85),1c 1d(41,10,67,4g,77,6Z,90,47,2w),1c 1d(3I,21,2,10,1R,1a,4n,23,6),1c 1d(3w,29,16,10,85,1e,3w,4k,26),1c 1d(57,18,10,1R,1R,2h,34,20,43),1c 1d(7d,20,15,36,3b,1e,68,1,26)),1c 1d(1c 1d(1R,61,71,37,34,53,31,2t,2G),1c 1d(69,60,71,38,73,8A,28,8E,37),1c 1d(68,45,1e,34,1,47,11,3n,1Q),1c 1d(62,17,19,70,4h,85,55,62,70),1c 1d(37,43,37,3y,1I,3b,85,4l,1),1c 1d(63,9,92,7b,28,64,32,3S,85),1c 1d(75,15,9,9,64,1a,7h,8A,16),1c 1d(86,6,28,5,64,1a,25,2n,1),1c 1d(56,8,17,8z,4I,1a,55,3x,1e),1c 1d(58,15,20,82,4D,57,26,5R,40)),1c 1d(1c 1d(aq,50,31,4I,3y,6z,25,35,5S),1c 1d(51,au,44,3J,3J,aB,31,6,fq),1c 1d(86,40,64,4D,7c,4j,45,1U,1e),1c 1d(22,26,17,3J,3z,3y,14,1,2u),1c 1d(45,16,21,91,64,8E,7,1,5x),1c 1d(56,21,39,2P,60,4g,23,1R,2h),1c 1d(83,12,13,54,2G,1a,68,47,28),1c 1d(85,26,85,85,1e,1e,32,4h,1Q),1c 1d(18,11,7,63,7G,1Q,4,4,4m),1c 1d(35,27,10,4h,8G,1Q,12,26,1e)),1c 1d(1c 1d(7k,80,35,99,7g,80,5K,54,45),1c 1d(85,5K,47,87,5Q,51,41,20,32),1c 1d(3w,75,1e,8a,7a,4h,3x,1e,85),1c 1d(56,41,15,5Q,2X,85,37,9,62),1c 1d(71,30,17,8A,7a,1a,17,18,4g),1c 1d(3w,38,60,4g,55,70,43,26,8I),1c 1d(4h,36,19,30,1Q,1a,97,27,20),1c 1d(4g,45,61,62,2g,1,81,7m,64),1c 1d(32,41,20,7d,5r,8I,20,21,3b),1c 1d(1V,19,12,61,3c,1e,48,4,24)));1f fx(a){1h(i=0;i<a.4L.1p;++i)a.4L[i]=1a;a.2a=1w(cS)}1f fy(a,b){1b c=b.8p;c[c.1p-1]=0+4*b.1N;1b d=b.8q;b.4e=!1x(a,6A);if(!b.4e){1b e=1x(a,iH)?1x(a,1e)?9V:9U:1x(a,3b)?9T:9S;b.6R[0]=e;1h(i=0;i<4;++i)c[i+c[c.1p-1]]=e;1h(i=0;i<4;++i)d[i]=e}1l{1b f=b.6R;1b g=0;1b y;1h(y=0;y<4;++y){1b e=d[y];1b x;1h(x=0;x<4;++x){1b h=cT[c[c[c.1p-1]+x]][e];1b i=0;do i=cR[2*i+1x(a,h[i])];1y(i>0);e=-i;c[c[c.1p-1]+x]=e;f[g]=e;g++}d[y]=e}}b.a9=!1x(a,8I)?9S:!1x(a,2w)?9T:1x(a,1U)?9V:9U}1b cU=1c 1d(1c 1d(1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(5Q,4m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2j,2Q,1O,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2k,1u,1u,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,8H,1O,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2x,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1u,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,4m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2O,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1m,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,2n,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1C,1a,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1C,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1m,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1u,1a,1m,1a,1a,1a,1a,1a,1a),1c 1d(2o,1a,1m,1a,1m,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a))),1c 1d(1c 1d(1c 1d(6G,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(3T,1O,2Q,1u,1a,1a,1m,1a,1a,1a,1a),1c 1d(2x,2o,2Q,2o,1u,1a,1u,1m,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2j,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(8B,1u,1m,1m,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,2n,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2k,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1u,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2s,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1O,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1u,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2o,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a))),1c 1d(1c 1d(1c 1d(5T,1C,2o,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2x,1C,8H,1m,1a,1a,1a,1a,1a,1a,1a),1c 1d(1C,1C,2t,1u,1m,1a,1m,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2X,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1C,1u,1u,1m,1m,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1m,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a))),1c 1d(1c 1d(1c 1d(2n,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2o,1m,1O,1m,1a,1a,1a,1a,1a,1a,1a),1c 1d(2n,1m,2k,1u,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1u,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(4m,1u,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1O,1m,1C,1m,1m,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1m,1O,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2n,1m,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1u,1a,1m,1m,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1C,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(3n,1C,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1u,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1C,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1O,1u,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1m,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1O,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2k,1a,1m,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1m,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1u,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(2o,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a)),1c 1d(1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1m,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a),1c 1d(1a,1a,1a,1a,1a,1a,1a,1a,1a,1a,1a))));1f fz(a,d){1b e=d.2F;1b t,b,c,p;1h(t=0;t<9W;++t)1h(b=0;b<9X;++b)1h(c=0;c<8d;++c)1h(p=0;p<8e;++p)if(1x(a,cU[t][b][c][p]))e.2a[t][b][c][p]=2L(a,8);d.8o=1A(a);if(d.8o)d.a8=2L(a,8)}1b cV=12;1b cW=20;1n.iI=1f(a){1g bM<<16|bN<<8|bO};1f aD(a){a.6M="5i";a.a6="iJ"}1b cX;1f dR(a,b){if(b!=bz){2z("iK 6j");1g 0}if(a);1g 1}1f fA(a){1b b=1w(cg);if(b){aD(b);b.3Y=0}1g b}1f fB(a){if(a){aE(a);a=0}}1f 1z(a,b,c){a.6M=b;a.a6=c;a.3Y=0;2z(b+": "+c);1g 0}1f 4Y(a,b){1g a[b+0]|a[b+1]<<8|a[b+2]<<16|a[b+3]<<24}1f aF(a,b,c,d,e,f){if(!a||!c||!d||!e)1g 0;if(c.1i>=8)if(!6d(a,b.1i,"iL ",4)){d.1i=1;e.1i=4Y(a,b.1i+4);if(f.1i>=cV&&e.1i>f.1i-cV)1g 0;b.1i+=8;c.1i-=8}1l{d.1i=0;e.1i=0}1l{d.1i=-1;e.1i=0}1g 1}1f fC(a,b,c,d,e,f,g){if(c.1i<10)1g 0;if(a[b.1i+3]!=3m||a[b.1i+4]!=1||a[b.1i+5]!=42)1g 0;1l{1b i=a[b.1i+0]|a[b.1i+1]<<8|a[b.1i+2]<<16;1b j=!(i&1)+0;1b w=(a[b.1i+7]<<8|a[b.1i+6])&6g;1b h=(a[b.1i+9]<<8|a[b.1i+8])&6g;if(g){if(c.1i<11)1g 0;g.1i=!!(a[b.1i+10]&1e)}if(!j)1g 0;if((i>>1&7)>3)1g 0;if(!(i>>4&1))1g 0;if(i>>5>=d)1g 0;if(e)e.1i=w;if(f)f.1i=h;1g 1}}1f aG(a,b,c,d,e,f,g){if(!a||!c||!d)1g 0;if(c.1i>=cW)if(!6d(a,b.1i,"fD",4)){1b h=4Y(a,b.1i+4);d.1i=1;if(h.1i!=cW-8)1g 0;if(g)g.1i=4Y(a,b.1i+8);if(e)e.1i=4Y(a,b.1i+12);if(f)f.1i=4Y(a,b.1i+16);b.1i+=cW;c.1i-=cW}1l d.1i=0;1l d.1i=-1;1g 1}1f fE(a){1K(a);a.5z=0;a.5A=0;a.6H=1;1h(i=0;i<a.6I.1p;++i)a.6I[i]=0;1h(i=0;i<a.6J.1p;++i)a.6J[i]=0}1f fF(a,b,c){1K(a);1K(b);b.5z=1A(a);if(b.5z){b.5A=1A(a);if(1A(a)){1b s;b.6H=1A(a);1h(s=0;s<3o;++s)b.6I[s]=1A(a)?2R(a,7):0;1h(s=0;s<3o;++s)b.6J[s]=1A(a)?2R(a,6):0}if(b.5A){1b s;1h(s=0;s<bQ;++s)c.4L[s]=1A(a)?2L(a,8):1a}}1l b.5A=0;1g!a.4C}1f fG(a,b,c,d){1b e=a.6N;1b f=b;1b g=c;1b h=b,7o=c+d;1b i;1b j=0;1b k=1j;1b p=1j;a.8m=1<<2L(e,2);k=a.8m-1;i=b;1b j=c+k*3;if(7o<j)1g"3Q";1h(p=0;p<k;++p){1b l=f[g+0]|f[g+1]<<8|f[g+2]<<16;1b m=i;1b n=j+l;if(n>7o)m=h;7Z(a.8n[+p],i,j,n);i=m;j=n;g+=3}7Z(a.8n[+k],i,j,7o);1g j<7o?"5i":"9F"}1f fH(a,b){1b c=b.3p;c.a1=1A(a);c.6K=2L(a,6);c.5B=2L(a,3);c.8f=1A(a);if(c.8f)if(1A(a)){1b i;1h(i=0;i<8c;++i)if(1A(a))c.a2[i]=2R(a,6);1h(i=0;i<e7;++i)if(1A(a))c.a3[i]=2R(a,6)}b.2l=c.6K==0?0:c.a1?1:2;if(b.2l>0)if(b.3Z.5z){1b s;1h(s=0;s<3o;++s){1b d=b.3Z.6J[s];if(!b.3Z.6H)d+=c.6K;b.8u[s]=d}}1l b.8u[0]=c.6K;1g!a.4C}1f 8J(a,b){1b c={1i:0};1b d=1o;1b e={1i:2i};1b f={1i:2i};1b g={1i:2i};1b h={1i:0};1b i={1i:0};1b j=1w(bX);1b k=1w(bY);1b l=1w(bJ);1b m="6o";if(a==1k){2z("(iM == 1k)");1g 0}aD(a);if(b==1k)1g 1z(a,"2f","1k fI iN 9B 8J()");d=b.2A;c.1i=b.7U;e.1i=b.9G;if(d==1k||e.1i<=4)1g 1z(a,"3Q","9A d9 2A 9B 5c am 7p");if(!aH(d,c,e,f))1g 1z(a,1L,"4o: fJ 4o fK");if(!aG(d,c,e,h,1k,1k,1k))1g 1z(a,1L,"4o: fJ fD fK");if(!aF(d,c,e,i,g,f))1g 1z(a,1L,"4o: aI 5h aJ.");if(i.1i==-1)1g 1z(a,"1L","4o: aI 5h aJ.");if(e.1i<4)1g 1z(a,3Q,"4o: iO 7p.");c=c.1i;e=e.1i;1b n=d[c+0]|d[c+1]<<8|d[c+2]<<16;j=a.a7;j.5y=!(n&1)+0;j.9Y=n>>1&7;j.9Z=n>>4&1;j.3U=n>>5;if(j.9Y>3)1g 1z(a,"1L","iP iQ iR.");if(!j.9Z)1g 1z(a,"7P","fj fg iS.");c+=3;e-=3;k=a.2T;if(j.5y){if(e<7)1g 1z(a,"3Q","8K 5c iT 7p");if(7D(d[c+0])!=3m||7D(d[c+1])!=1||7D(d[c+2])!=42)1g 1z(a,"1L","iU iV iW");k.4K=(d[c+4]<<8|d[c+3])&6g;k.e9=d[c+4]>>6;k.3V=(d[c+6]<<8|d[c+5])&6g;k.ea=d[c+6]>>6;c+=7;e-=7;a.4O=k.4K+15>>4;a.5E=k.3V+15>>4;b.1r=k.4K;b.1q=k.3V;b.5k=0;b.5j=0;b.2C=0;b.2B=0;b.6s=b.1r;b.4B=b.1q;b.2D=b.1r;b.2J=b.1q;fx(a.2F);fE(a.3Z);a.6S=0}if(j.3U>e)1g 1z(a,"3Q","iX iY 1p");a.5G=1k;a.8v=0;1b l=a.6N;7Z(l,d,c,c+j.3U);c+=j.3U;e-=j.3U;if(j.5y){k.a0=1A(l);k.eb=1A(l)}if(!fF(l,a.3Z,a.2F))1g 1z(a,"1L","8K 5c iZ 7p");if(!fH(l,a))1g 1z(a,"1L","8K 5c j0 7p");m=fG(a,d,c,e);if(m!="5i")1g 1z(a,"1L","8K 5c j1");fr(a);if(!j.5y)1g 1z(a,7P,"9A a j2 am.");1l a.ec=3|1T;1A(l);fz(l,a);if(a.2T.a0){1b o=8;1b p=1;1b q=d;1b r=c-o;1b s=5Z;if(j.3U<o||q[r+o-1]!=p);s=q[r+4]<<0|q[r+5]<<8|q[r+6]<<16;if(j.3U<s+o)1g 1z(a,1L,"4o: aI j3 aJ.");a.5G=s>0?q:1k;a.aa=s>0?r-s:1k;a.8v=s;s=q[r+0]<<0|q[r+1]<<8|q[r+2]<<16;a.8w=s;a.ee=1k;a.ed=q[r+3]}a.3Y=1;1g 1}1b cY=1c 1d(0,1,2,3,6,4,5,6,6,6,6,6,6,6,6,7,0);1b cZ=1c 1d(6B,7c,5L,0);1b da=1c 1d(5Q,2P,5L,4D,0);1b db=1c 1d(7g,3m,4J,4X,4W,0);1b dc=1c 1d(1m,1m,2t,7i,4k,6C,9L,5L,6z,4W,2I,0);1b dd=1c 1d(cZ,da,db,dc);1b de=1c 1d(0,1,4,8,5,2,3,6,9,12,13,10,7,11,14,15);1b df=9u(1c 1d(8d,8e),"");1f 8L(a,b,c,d,n,e){1b p=b[cY[n]][c];if(!1x(a,p[0]))1g 0;1y(1){++n;if(!1x(a,p[1]))p=b[cY[n]][0];1l{1b v,j;if(!1x(a,p[2])){p=b[cY[n]][1];v=1}1l{if(!1x(a,p[3]))if(!1x(a,p[4]))v=2;1l v=3+1x(a,p[5]);1l if(!1x(a,p[6]))if(!1x(a,p[7]))v=5+1x(a,3R);1l{v=7+2*1x(a,5w);v+=1x(a,6A)}1l{1b f=1o;1b g=1x(a,p[8]);1b h=1x(a,p[9+g]);1b k=2*g+h;v=0;f=dd[k];1b l;1h(i=0;i<f.1p-1;++i)v+=v+1x(a,f[i]);v+=3+(8<<k)}p=b[cY[n]][2]}j=de[n-1];e[e[e.1p-1]+j]=dV(a,v)*d[(j>0)+0];if(n==16||!1x(a,p[0]))1g n}if(n==16)1g 16}}1b dg={i8:1v(4,1o),j4:2i};1b dh=1c 1d(1c 1d(0,0,0,0),1c 1d(1,0,0,0),1c 1d(0,1,0,0),1c 1d(1,1,0,0),1c 1d(0,0,1,0),1c 1d(1,0,1,0),1c 1d(0,1,1,0),1c 1d(1,1,1,0),1c 1d(0,0,0,1),1c 1d(1,0,0,1),1c 1d(0,1,0,1),1c 1d(1,1,0,1),1c 1d(0,0,1,1),1c 1d(1,0,1,1),1c 1d(0,1,1,1),1c 1d(1,1,1,1));1b di=j5;1f 3A(X,S){1g((X[0]*j6+X[1]*j7+X[2]*1T+X[3]*1)*di&j8)>>S}1f fL(a,b,c){1b d,8M,8N;1b e=df;1b q=a.6P[a.6S];1b f=a.2a;1b g=a.4P[1-1];1b h=1v(4,0),7q=1v(4,0);1b i=1v(4,0),3B=1v(4,0);1b j=0;1b k=0;1b x,y,ch;f=4w(0,f8*1S(f));if(!a.4e){1b m=1v(16,0);1b n=b.3W+g.3W;b.3W=g.3W=(8L(c,a.2F.2a[1],n,q.5D,0,m)>0)+0;8N=1;e=a.2F.2a[0];et(m,f);f[f.1p-1]=0}1l{8N=0;e=a.2F.2a[3]}i=6c(dh[b.2S&15]);3B=6c(dh[g.2S&15]);1h(y=0;y<4;++y){1b l=3B[y];1h(x=0;x<4;++x){1b n=l+i[x];1b o=8L(c,e,n,q.8g,8N,f);i[x]=l=(o>0)+0;7q[x]=(f[f[f.1p-1]+0]!=0)+0;h[x]=(o>1)+0;f[f.1p-1]+=16}3B[y]=l;k|=3A(7q,24-y*4);j|=3A(h,24-y*4)}d=3A(i,24);8M=3A(3B,24);i=6c(dh[b.2S>>4]);3B=6c(dh[g.2S>>4]);1h(ch=0;ch<4;ch+=2){1h(y=0;y<2;++y){1b l=3B[ch+y];1h(x=0;x<2;++x){1b n=l+i[ch+x];1b o=8L(c,a.2F.2a[2],n,q.8h,0,f);i[ch+x]=l=(o>0)+0;7q[y*2+x]=(f[f[f.1p-1]+0]!=0)+0;h[y*2+x]=(o>1)+0;f[f.1p-1]+=16}3B[ch+y]=l}k|=3A(7q,8-ch*2);j|=3A(h,8-ch*2)}d|=3A(i,20);8M|=3A(3B,20);b.2S=d;g.2S=8M;a.2a=f;a.4R=j+0;a.3u=j|k;b.6L=!a.3u+0}1b dj;1f fM(a,b){1b c=a.6N;1b d=a.4P[1-1];1b e=a.4P[1+a.1N];if(a.3Z.5A)a.6S=!1x(c,a.2F.4L[0])?0+1x(c,a.2F.4L[1]):2+1x(c,a.2F.4L[2]);e.6L=a.8o?1x(c,a.a8):0;fy(c,a);if(c.4C)1g 0;if(!e.6L)fL(a,e,b);1l{d.2S=e.2S=0;if(!a.4e)d.3W=e.3W=0;a.3u=0;a.4R=0}1g!b.4C}1f fN(a){1b b=a.4P[1-1];b.2S=0;b.3W=0;5e(a.8q,0,bP,a.8q.1p);a.4M=(a.2l>0&&a.1D>=a.8l&&a.1D<=a.5F)+0}1f fO(a,b){1h(a.1D=0;a.1D<a.5F;++a.1D){1b c=a.8n[a.1D&a.8m-1];fN(a);1h(a.1N=0;a.1N<a.4O;a.1N++){if(!fM(a,c))1g 1z(a,"3Q","j9 ja-jb-jc jd."+a.1N+" "+a.1D);fl(a);fe(a)}if(!fh(a,b))1g 1z(a,"7Q","je jf.")}if(a.8w>0)if(!em(a))1g 0;1g 1}1f aK(a,b){1b c=0;if(a==1k)1g 0;if(b==1k)1g 1z(a,"2f","jg fI jh in aK().");if(!a.3Y)if(!8J(a,b))1g 0;1K(a.3Y);c=fi(a,b)==bE;if(c){if(c)c=fa(a,b);if(c)c=fO(a,b);c&=fk(a,b)}if(!c){aE(a);1g 0}a.3Y=0;1g 1}1f aE(a){if(a==1k)1g;if(a.4a);if(a.4Q)a.4Q=0;a.4Q=1k;a.6Q=0;a.3Y=0}1b dk=16,3C=-3K,8O=1T+5O;1f fP(y,u,v,a,b){1b c=dm[v];1b d=dn[v]+aL[u]>>dk;1b e=aM[u];a[b+0]=dp[y+c-3C];a[b+1]=dp[y+d-3C];a[b+2]=dp[y+e-3C]}1f aN(y,u,v,a,b){fP(y,u,v,a,b+1)}1f aO(y,u,v,a,b){a[b+0]=1a;aN(y,u,v,a,b)}1b dl=1<<dk-1;1b dm=1v(1T,7C),aM=1v(1T,7C);1b dn=1v(1T,9m),aL=1v(1T,9m);1b dp=1v(8O-3C,1o);1b dq=1v(8O-3C,1o);1b dr=0;1f 2W(v,a){1g v<0?0:v>a?a:v}1f fQ(a){1b i;if(dr)1g;1h(i=0;i<1T;++i){dm[i]=ji*(i-1e)+dl>>dk;aL[i]=-jj*(i-1e)+dl;dn[i]=-jk*(i-1e);aM[i]=jl*(i-1e)+dl>>dk}1h(i=3C;i<8O;++i){1b k=(i-16)*jm+dl>>dk;dp[i-3C]=2W(k,1a);dq[i-3C]=2W(k+8>>4,15)}dr=1}1f 7r(u,v){1g u|v<<16}1f aP(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s){1b x;1b t=q-1>>1;1b u=7r(e[f+0],g[h+0]);1b v=7r(i[j+0],k[l+0]);if(a){1b w=3*u+v+8P>>2;r(a[b+0],w&1a,w>>16,m,n)}if(c){1b w=3*v+u+8P>>2;r(c[d+0],w&1a,w>>16,o,p)}1h(x=1;x<=t;++x){1b y=7r(e[f+x],g[h+x]);1b z=7r(i[j+x],k[l+x]);1b A=u+y+v+z+jn;1b B=A+2*(y+v)>>3;1b C=A+2*(u+z)>>3;if(a){1b w=B+u>>1;1b D=C+y>>1;r(a[b+2*x-1],w&1a,w>>16,m,n+(2*x-1)*s);r(a[b+2*x-0],D&1a,D>>16,m,n+(2*x-0)*s)}if(c){1b w=C+v>>1;1b D=B+z>>1;r(c[d+2*x-1],w&1a,w>>16,o,p+(2*x-1)*s);r(c[d+2*x+0],D&1a,D>>16,o,p+(2*x+0)*s)}u=y;v=z}if(!(q&1)){if(a){1b w=3*u+v+8P>>2;r(a[b+q-1],w&1a,w>>16,m,n+(q-1)*s)}if(c){1b w=3*v+u+8P>>2;r(c[d+q-1],w&1a,w>>16,o,p+(q-1)*s)}}}1f fR(A,a,B,b,C,c,D,d,E,e,F,f,G,g,H,h,l){aP(A,a,B,b,C,c,D,d,E,e,F,f,G,g,H,h,l,aO,4)}1f fS(A,a,B,b,C,c,D,d,E,e,F,f,G,g,H,h,l){aP(A,a,B,b,C,c,D,d,E,e,F,f,G,g,H,h,l,aN,4)}1b ds=1c 1d(7I);1b dt=1c 1d(7I);1f fT(a){ds[3e]=fR;dt[3e]=fS}1f fU(a,b,c,d,u,e,v,f,g,h,j,k,l,m,n){1b i;1h(i=0;i<l-1;i+=2){m(a[b+0],u[e+0],v[f+0],g,h);m(a[b+1],u[e+0],v[f+0],g,h+n);m(c[d+0],u[e+0],v[f+0],j,k);m(c[d+1],u[e+0],v[f+0],j,k+n);b+=2;d+=2;e++;f++;h+=2*n;k+=2*n}if(i==l-1){m(a[b+0],u[e+0],v[f+0],g,h);m(c[d+0],u[e+0],v[f+0],j,k)}}1f fV(A,a,B,b,C,c,D,d,E,e,F,f,l){fU(A,a,B,b,C,c,D,d,E,e,F,f,l,aO,4)}1b du=1c 1d(0,0,0,0,fV,0,0);1b dv=0;1f fW(a,p){1b b=p.1P;1b c=b.u.2r;1b d=c.3N;1b e=c.5g+a.3i*c.1Z;1b f=a.y;1b g=a.3f;1b h=a.u;1b i=a.3g;1b k=a.v;1b l=a.3h;1b m=du[b.2q];1b n=a.2D;1b o=a.2J-1;1b j;1h(j=0;j<o;j+=2){m(f,g,f,g+a.3P,h,i,k,l,d,e,d,e+c.1Z,n);g+=2*a.3P;i+=a.5l;l+=a.5l;e+=2*c.1Z}if(j==o)m(f,g,f,g,h,i,k,l,d,e,d,e,n);1g a.2J}1f fX(a,p){1b b=a.2J;1b c=p.1P.u.2r;1b d=c.3N;1b e=c.5g+a.3i*c.1Z;1b f=a.a?dt[p.1P.2q]:ds[p.1P.2q];1b g=a.y;1b h=a.3f;1b i=a.u;1b j=a.3g;1b k=a.v;1b l=a.3h;1b m=p.5n;1b n=p.6v;1b o=p.6t;1b q=p.7V;1b y=a.3i;1b r=a.3i+a.2J;1b s=a.2D;1b t=4v((s+1)/2);if(y==0)f(1k,1k,g,h,i,j,k,l,i,j,k,l,1k,1k,d,e,s);1l{f(p.5m,p.6u,g,h,m,n,o,q,i,j,k,l,d,e-c.1Z,d,e,s);b++}1h(;y+2<r;y+=2){m=i;n=j;o=k;q=l;j+=a.5l;l+=a.5l;e+=2*c.1Z;h+=2*a.3P;f(g,h-a.3P,g,h,m,n,o,q,i,j,k,l,d,e-c.1Z,d,e,s)}h+=a.3P;if(a.2C+r<a.4B){1G(p.5m,p.6u,g,h,s*1S(p.5m));1G(p.5n,p.6v,i,j,t*1S(p.5n));1G(p.6t,p.7V,k,l,t*1S(p.6t));b--}1l if(!(r&1))f(g,h,1k,1k,i,j,k,l,i,j,k,l,d,e+c.1Z,1k,1k,s);1g b}1f fY(a,p){1b b=p.1P.2q;1b c=b==3e?0:b==6m?1:3;1b d=b==6m?2:4;1b e=a.2D;1b f=a.2J;1b i,j;1b g=p.1P.u.2r;1b h=g.3N;1b k=g.5g+a.3i*g.1Z;1b l=a.a;1b m=a.3O;if(l!=1k)1h(j=0;j<f;++j){1h(i=0;i<e;++i)h[k+d*i+c]=l[m+i];m+=a.1r;k+=g.1Z}1g 0}1b dw=30;1f jo(x,y){1g x*y+(1<<dw-1)>>dw}1f fZ(a){1g a==9C||a==9D||a==3e||a==6m||a==7H}1f g0(a,b){1b W=b.1r;1b H=b.1q;1b x=0,y=0,w=W,h=H;b.5j=a!=1k&&a.5j>0;if(b.5j){w=a.dI;h=a.dJ;x=a.2B&~1;y=a.2C&~1;if(x<0||y<0||w<=0||h<=0||x+w>W||y+h>H)1g 0}b.2B=x;b.2C=y;b.6s=x+w;b.4B=y+h;b.2D=w;b.2J=h;b.5k=(a!=1k&&a.5k>0)+0;b.6p=a&&a.6p;b.7T=(a==1k||!a.dH)+0;1g 1}1f g1(a){1b p=a.6q;1b b=p.1P.2q<4A;p.3j=1k;p.6w=1k;p.6x=1k;if(!g0(p.7W,a))1g 0;if(a.5k);1l{if(b){p.6w=fW;if(a.7T){1b c=a.2D+1>>1;p.3j=9s(a.2D+2*c,1M);if(p.3j==1k){2z("3j 6j #2");1g 0}p.5m=p.3j;p.6u=0;p.5n=p.5m;p.6v=p.6u+a.2D;p.6t=p.5n;p.7V=p.6v+c;p.6w=fX;fT()}}1l;if(fZ(p.1P.2q))p.6x=b?fY:0}if(b)fQ();1g 1}1f g2(a){1b p=a.6q;1b b=a.2D;1b c=a.2J;1b d;1K(!(a.3i&1));if(b<=0||c<=0)1g 0;d=p.6w(a,p);p.dS+=d;if(p.6x)p.6x(a,p);1g 1}1f g3(a){1b p=a.6q;p.3j="";p.3j=1k}1f g4(a,b){b.7R=g2;b.6r=g1;b.7S=g3;b.6q=a}1b cV=12;1f aH(a,b,c,d){if(c.1i>=cV&&!6d(a,b.1i,"4o",4))if(6d(a,b.1i+8,"jp",4))1g 0;1l{d.1i=4Y(a,b.1i+4);if(d.1i<cV)1g 0;b.1i+=cV;c.1i-=cV}1l d.1i=0;1g 1}1f 8Q(a){if(a){}}1f 8R(a,b,c,d){1b e=1c fA;1b f=bE;1b g=1w(bH);1b h=1;1K(d);if(e==1k)1g 2f;dQ(g);g.2A=a;g.7U=b;g.9G=c;g4(d,g);e.4a=0;if(!8J(e,g))f=1L;1l{f=eh(g.1r,g.1q,d.7W,d.1P);if(f==bE)if(!aK(e,g))f=e.6M}fB(e);if(f!=bE)1n.ei(d.1P);1g f}1f g5(a,b,c,d,e,f){1b g=1w(bI);1b h=1w(bD);if(d==1k)1g 1k;7N(h);8Q(g);g.1P=h;h.2q=a;h.u.2r.3N=d;h.u.2r.5g=0;h.u.2r.1Z=e;h.u.2r.5h=f;h.7L=1;if(8R(b,0,c,g)!=bE)1g 1k;1g d}1f jq(a,b,c,d,e){1g g5(3e,a,b,c,e,d)}1f g6(a,b,c,d,e,f){1b g={1i:0};1b c={1i:c};1b h=1w(bI);1b i=1w(bD);7N(i);8Q(h);h.1P=i;i.2q=a;1b o={7U:{1i:0},1r:{1i:i.1r},1q:{1i:i.1q}};if(!g7(b,g,c,o.1r,o.1q))1g 1k;i.1r=o.1r.1i;i.1q=o.1q.1i;if(d)d.1i=i.1r.1i;if(e)e.1i=i.1q.1i;if(8R(b,g.1i,c.1i,h)!=bE)1g 1k;if(f)ad(i,f);1g a>=4A?i.u.dB.y:i.u.2r.3N}1n.jr=1f(a,b,c,d){1g g6(3e,a,b,c,d,1k)};1f aQ(a){1K(a);a.dE=0}1f 8S(a,b,c,d){1b e={1i:0};1b f={1i:0};1b g={1i:0};1b h={1i:0};1b i={1i:0};if(d==1k)1g 2f;aQ(d);if(a==1k||b==1k||c.1i==0)1g 2f;if(!aH(a,b,c,f))1g 1L;if(!aG(a,b,c,h,d.1r,d.1q,g))1g 1L;if(h.1i>0)1g bE;if(!aF(a,b,c,i,e,f))1g 1L;if(i.1i==-1)1g 1L;if(!i.1i)e.1i=c.1i;if(!fC(a,b,c,e,d.1r,d.1q,d.dD))1g 1L;1g bE}1f g7(a,b,c,d,e){1b f=1w(bF);if(8S(a,b,c,f)!=bE)1g 0;if(d)d.1i=f.1r;if(e)e.1i=f.1q;1g 1}1f dP(a,b){if(b!=bz)1g 0;if(a==1k)1g 0;aQ(a.6l);7N(a.1P);1g 1}1f dG(a,b,c,d){if(d!=bz)1g 2f;if(c==1k)1g 2f;1b e={1i:0};1b b={1i:b};1g 8S(a,e,b,c)}1n.g8=1f(a,b,c){1b d=1w(bI);1b e="6o";if(!c)1g 2f;1b f={1i:0};b={1i:b};e=8S(a,f,b,c.6l);if(e!=bE)1g e;8Q(d);d.1P=c.1P;d.7W=c.dN;e=8R(a,f.1i,b.1i,d);1g e}}if(!2y.4Z)2y.4Z=1f(c,d){1n.el=c;1n.2Y=1f(a){1b b=/(\\-([a-z]){1})/g;if(a=="jt")a="ju";if(b.7s(a))a=a.3D(b,1f(){1g 4p[2].jv()});1g c.2Z[a]?c.2Z[a]:1k};1g 1n};1b g9="<\\!-- aR --\\>\\r\\n"+"8T aR(7t)\\r\\n"+"\\jw = jx(7t)\\r\\n"+"ga 8T\\r\\n"+"8T gb(7t)\\r\\n"+"\\jy aS\\r\\n"+"\\jz = jA(7t)\\r\\n"+"\\jB aS jC 2 jD\\r\\n"+"\\t\\gc = jE( jF( jG( 7t, aS, 1 ) ) )\\r\\n"+"\\jH\\r\\n"+"\\t\\gc = "+\'""\'+"\\r\\n"+"\\jI jJ\\r\\n"+"ga 8T\\r\\n";1f gd(){1b a=1B.4q("aT");a.aU="aV/jK";1b s=1B.aW("aT")[0];a.5a=g9;s.aX.ge(a,s)}1f gf(b){1b c={};1h(1b i=0;i<1T;i++)1h(1b j=0;j<1T;j++)c[6e.6f(i+j*1T)]=6e.6f(i)+6e.6f(j);8U{1b d=aR(b);1b f=gb(b);1g d.3D(/[\\s\\S]/g,1f(a){1g c[a]})+f}8V(e){1g 1k}}1f gg(){1b D="gh-0.0.2.8W.js";1b E="gh-0.0.2.jL";1b F="";1b G=1B.aW("aT");1b H=G.1p;1h(1b i=0;i<H;++i)if(G[i].3E.2e(D)>=0){F=G[i].3E.3F(0,G[i].3E.gi("/")+1);2p}1b I=F+E;1f gj(){1b a=1c jM;a.gk=1f(){if(a.1r==2&&a.1q==2)8X();1l 8X()};a.jN=1f(){8X()};1b b="2A:8Y/gl;gm,jO/jP/jQ//jR";a.3E=b;a.aY("3E",b)}gj();1b J=4y;1f 8X(){if(J)1g;J=5f;1f gn(a){if(a.3F(a.1p-5,a.1p)==".gl")1g 1;1l 1g 0}1b p=1B.4q("8Z");1f go(a,b){if(b.2e("jS://")!=0)b=a+""+b;p.3E=b;b=p.3E;1g b}1f aZ(a,b,c,d){if(gn(b))gp(a,b,c,d)}1b q=[];1f gp(a,b,c,d){b=go(a,b);q.1t(1c 1d(b,c,d?d:0))}1f gq(a){1b c=(a.3F(a.2e("4r")+4).3F(0,1)==\'"\'||a.3F(a.2e("4r")+4).3F(0,1)=="\'")+0;1b b=a.3F(a.2e("4r")+4+c,a.gi(")")-c-(a.2e("4r")+4+c));1g b}1b r=1B.b0.aW("*");1h(1b i=0;i<1B.b1.1p;i++)aZ("",1B.b1[i].3E,1B.b1[i],1);1h(1b s=0;s<r.1p;s++){1b t=r[s];1b u=2y.4Z(t,1k).2Y("7u-8Y");if(u.jT("4r")){1b v=gq(u);aZ("",v,t)}}1b x=0;if(5d 9o!=="7v"&&!!1B.4q("b2").9a){1b z=5d gr!=="7v"?1c gr:2y.gs?1c gs("jU.jV"):1k;1b A=1c 9w}(1f(){1b d="jW+/";1f gt(a){1b b,i,7w;1b c,c2,c3;7w=a.1p;i=0;b="";1y(i<7w){c=a.6a(i++)&1a;if(i==7w){b+=d.3G(c>>2);b+=d.3G((c&3)<<4);b+="==";2p}c2=a.6a(i++);if(i==7w){b+=d.3G(c>>2);b+=d.3G((c&3)<<4|(c2&3z)>>4);b+=d.3G((c2&15)<<2);b+="=";2p}c3=a.6a(i++);b+=d.3G(c>>2);b+=d.3G((c&3)<<4|(c2&3z)>>4);b+=d.3G((c2&15)<<2|(c3&2G)>>6);b+=d.3G(c3&63)}1g b}if(!2y.b3)2y.b3=gt})();b4.1J.9b=1f(){1g 1n<0?1n+jX:1n};b4.1J.4s=1f(){1g[1n>>>24&1a,1n>>>16&1a,1n>>>8&1a,1n&1a]};b4.1J.b5=1f(){1g[1n&1a,1n>>>8&1a]};1d.1J.gu=1f(c,d){9y(4p.1p){4z 0:c=0;4z 1:d=1n.1p-c}1b a=1,b=0;1h(1b i=0;i<d;i++){a=(a+1n[c+i])%9z;b=(b+a)%9z}1g(b<<16|a).9b()};1d.1J.9c=1f(a,b){9y(4p.1p){4z 0:a=0;4z 1:b=1n.1p-a}1b d=4p.9d.gv;if(!d){d=[];1b c;1h(1b n=0;n<1T;n++){c=n;1h(1b k=0;k<8;k++)c=c&1?jY^c>>>1:c>>>1;d[n]=c.9b()}4p.9d.gv=d}1b c=gw;1h(1b i=0;i<b;i++)c=d[(c^1n[a+i])&1a]^c>>>8;1g(c^gw).9b()};(1f(){1b l=1f(){1b a=1d.1J.6b.jZ(1n.9a("2d").k0(0,0,1n.1r,1n.1q).2A);1b w=1n.1r;1b h=1n.1q;1b b=[4I,80,78,71,13,10,26,10,0,0,0,13,73,72,68,82];1d.1J.1t.2H(b,w.4s());1d.1J.1t.2H(b,h.4s());b.1t(8,6,0,0,0);1d.1J.1t.2H(b,b.9c(12,17).4s());1b d=h*(w*4+1);1h(1b y=0;y<h;y++)a.k1(y*(w*4+1),0,0);1b e=gx.k2(d/4x);1d.1J.1t.2H(b,(d+5*e+6).4s());1b f=b.1p;1b g=d+5*e+6+4;b.1t(73,68,65,84,6k,1);1h(1b i=0;i<e;i++){1b j=gx.8W(4x,d-i*4x);b.1t(i==e-1?1:0);1d.1J.1t.2H(b,j.b5());1d.1J.1t.2H(b,(~j).b5());1b k=a.6b(i*4x,i*4x+j);1d.1J.1t.2H(b,k)}1d.1J.1t.2H(b,a.gu().4s());1d.1J.1t.2H(b,b.9c(f,g).4s());b.1t(0,0,0,0,73,69,78,68);1d.1J.1t.2H(b,b.9c(b.1p-4,4).4s());1g"2A:8Y/gy;gm,"+b3(b.gz(1f(c){1g 6e.6f(c)}).9p(""))};if(5d 7x!=="7v"){1b m=7x.1J.5V;7x.1J.5V=1f(a){1b b=m.2H(1n,4p);if(b=="2A:,"){7x.1J.5V=l;1g 1n.5V()}1l{7x.1J.5V=m;1g b}}}})();1f gA(a,b){if(a!=1k){1b c=b.1q.1i;1b d=b.1r.1i;1b e=1B.4q("b2");e.id="b6";e.5a="aV";1B.b0.gB(e);1b f=1B.9e("b6");f.1E.9f="gC";f.1q=c;f.1r=d;1b g=f.9a("2d");1b i=g.k3(f.1r,f.1q);1b j=i.2A;1h(1b h=0;h<c;h++)1h(1b w=0;w<d;w++){j[2+w*4+d*4*h]=a[3+w*4+d*4*h];j[1+w*4+d*4*h]=a[2+w*4+d*4*h];j[0+w*4+d*4*h]=a[1+w*4+d*4*h];j[3+w*4+d*4*h]=a[0+w*4+d*4*h]}g.k4(i,0,0);1b k=f.5V("8Y/gy");1B.b0.k5(1B.9e("b6"))}1l k=b.k6;1g k}1b B=[];1f gD(a,b){B.1t(1c 1d(a,b))}1f gE(a){1h(1b i=0;i<B.1p;i++)if(a===B[i][0])1g b7=B[i][1];1g 4y}1f 9g(a,b){if(a&&a.aU=="gF"){1b c=q[x][1];if(q[x][2])c.3E=a.b8;1l c.1E.k7="4r("+a.b8+")"}1l if(a==1k&&b=="as"){1b d=q[x][1];1b e=q[x][2];if(e==0){1b f;if(5d d.k8==="7v")gG(d,x,a)}1l if(e==1)gH(d,x,a)}}1f 5W(){9h(1f(){x++;if(x<q.1p)b9(x);if(x>=q.1p)B=[]},0)}1f b9(b){1b c=q[b][0];if(!!1B.4q("b2").9a)if(b7=gE(c)){9g(b7);5W()}1l{z.k9("ka",c);if(z.gI)z.gI("aV/kb; kc=x-gJ-gK");1l z.kd("ke-kf","x-gJ-gK");z.kg=1f(){if(z.c0==4)if(z.1F==ay)8U{if(5d z.gL=="7v")1b a=z.kh.9i("").gz(1f(e){1g e.6a(0)&1a});1l{gd();1b a=c9(gf(z.gL))}gM(c,a,"js")}8V(e){5W()}1l 5W()};z.ki()}1l 9g(1k,"as")}1f gN(o){1b e=1B.4q("4t");e.gB(o.kj(5f));1g e.5a}1f gH(a,b,c){1b d=2y.4Z(a,1k);1b e=q[b][0];1b f=a.5a;1b g=a.2Z?a.2Z["1r"]:2y.4Z(a,1k).2Y("1r");1b h=a.2Z?a.2Z["1q"]:2y.4Z(a,1k).2Y("1q");1b i=1B.4q("4t");i.1E.9f="gO";if(a.1E.c1!=="")i.1E.c1=a.1E.c1;if(a.c4!=="")i.c4=a.c4;if(a.id!=="")i.id=a.id+" ";1b j=/<8Z((\\s+\\w+=[^\\+]+))>/im.c5(gN(a))[1]+"";1b k=j.2e("1r=")>0?/(\\S+)=["\']?((?:.(?!["\']?\\s+(?:\\S+)=|["\']))+.)["\']?/.c5(j.3F(j.2e("1r=")))[2]:"";1b l=j.2e("1q=")>0?/(\\S+)=["\']?((?:.(?!["\']?\\s+(?:\\S+)=|["\']))+.)["\']?/.c5(j.3F(j.2e("1q=")))[2]:"";if((h+""+l).2e("%")>0&&gP(a)!==4y){l="";h="7y"}i.5a=\'<4t id="gQ\'+C+\'" 1E="9f:gO;1r:1I%;8W-1q: 1I%;1q:7y !gR;1q:1I%;"><9j 1E="" 1r="10" 1q="10" 4u="7z\'+C+\'" gS="7z\'+C+\'" gT="gU:gV-gW-gX-gY-gZ"><5X 4u="h0" 1i="4r=\'+e+"&h1=8Z&kk="+l.3D(/%/g,"%25")+"&kl="+k.3D(/%/g,"%25")+"&km="+h.3D(/%/g,"%25")+"&kn="+g.3D(/%/g,"%25")+"&id="+C+\'"/><5X 4u="h2" 1i="\'+I+\'"/><5X 4u="h3" 1i="h4"></9j></4t>\';a.1E.9f="gC";a.aX.ge(i,a.ko);C++}1f gG(a,b,c){1b d=2y.4Z(a,1k);1b e=q[b][0];1b f=a.5a;1b g=a.2Z?a.2Z["1r"]:d.2Y("1r");g=!!g&&g!="7y"?g:"1I%";1b h=a.2Z?a.2Z["1q"]:d.2Y("1q");h=!!h&&h!="7y"?h:"1I%";1b i=d.2Y("7u-h5");i=i?i:"h5";1b j=d.2Y("7u-3a");if(j==1k||j.9i(" ").1p<2)j=d.2Y("7u-3a-x")+" "+d.2Y("7u-3a-y");a.5a=\'<4t 1E="1r:1I%;8W-1q: 1I%;1q:7y !gR;1q:1I%; 3a:kp; z-kq:0"><9j 1E="3a:c6; c7:0; h6:0;" 1r="\'+g+\'" 1q="\'+h+\'" 4u="7z\'+C+\'" gS="7z\'+C+\'" gT="gU:gV-gW-gX-gY-gZ"><5X 4u="h0" 1i="4r=\'+e+"&h1=bg&kr="+i+"&ks="+j.3D(/%/g,"%25")+"&id="+C+\'"/><5X 4u="h2" 1i="\'+I+\'"/><5X 4u="h3" 1i="h4"></9j><4t 1E="3a:c6; c7:0; h6:0;">\'+f+"</4t></4t>";if(a.1E.3a!=""&&a.1E.h7=="")a.1E.h7="1";C++}1f gP(e){1b a=e.1E.3a;e.1E.3a="c6";1b b=e.1q;e.1E.3a=a;1g b!=e.1q?b:4y}1b C=0;2y["kt"]=1f(a,b){if(a=="1F"){b=b.9i("|");if(b[1]=="ku"||b[1]=="6j")5W()}1l if(a=="8Z"||a=="kv")if(b!=""){b=b.9i("|");1b c=1B.9e("gQ"+b[0]+"").aX;c.1E.1r=b[1];c.1E.1q=b[2];1b d=1B.9e("7z"+b[0]+"");d.aY("1r",b[1].2e("%")>0?"1I%":b[1].3D("h8",""));d.aY("1q",b[2].2e("%")>0?"1I%":b[2].3D("h8",""));d.1E.1r=b[1].2e("%")>0?"1I%":b[1];d.1E.1q=b[2].2e("%")>0?"1I%":b[2]}};1f gM(a,b,c){if(c="js"){8U{1b d={1r:{1i:0},1q:{1i:0}};1b e=1c 9w;1b f=4y;b=b;1b g=e.dM;1b h=g.1P;1b i=g.6l;if(!e.dO(g))f=5f;1b j=e.6o;1F=e.dF(b,b.1p,i);if(1F!=j.5i)f=5f;1b k=e.9E;h.2q=k.3e;1F=e.g8(b,b.1p,g);d.1r.1i=h.1r;d.1q.1i=h.1q;h9=1F==j.5i;if(!h9)f=5f;1b l=!f?h.u.2r.3N:1k}8V(kw){l=1k}1b m={b8:gA(l,d),aU:"gF"}}gD(a,m);9g(m);5W()}if(q.1p>0)b9(x)}}(1f(i){1b u=kx.ky.kz();1b b=4y;if(/kA/.7s(u))kB=9h(1f(){if(1B.c0=="kC"||1B.c0=="kD")i();1l 9h(4p.9d,10)},10);1l if(/kE/.7s(u)&&!/(kF)/.7s(u)||/kG/.7s(u))i();1l if(b)(1f(){1b a=1B.4q("1B:kH");8U{a.kI("c7");i();a=1k}8V(e){9h(4p.9d,0)}})();1l 2y.gk=i})(gg);', 0, 1285, "||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||255|var|new|Array|128|function|return|for|value|int_|null|else|254|this|uint8_t|length|height|width|AVG3|push|253|Arr|newObjectIt|VP8GetBit|while|VP8SetError|VP8Get|document|251|mb_y_|style|status|memcpy|127|100|prototype|assert|VP8_STATUS_BITSTREAM_ERROR|205|mb_x_|252|output|171|102|sizeof|256|183|112|tmp_off|AVG2|p0|stride|||||||||||coeffs_|cache_uv_stride_|q1||indexOf|VP8_STATUS_INVALID_PARAM|219|213|uint32_t|223|249|filter_type_|tmp|248|250|break|colorspace|RGBA|247|243|209|cache_y_stride_|114|234|window|alert2|data|crop_left|crop_top|mb_w|221|proba_|192|apply|129|mb_h|range_|VP8GetValue|191|175|239|155|241|VP8GetSignedValue|nz_|pic_hdr_|yuv_b_|q0|clip|236|getPropertyValue|currentStyle|||||||||||position|163|195|root|MODE_ARGB|y_off|u_off|v_off|mb_y|memory|143|211|157|245|NUM_MB_SEGMENTS|filter_hdr_|cache_y_|cache_u_|cache_y_off|cache_u_off|non_zero_|MUL|101|116|154|240|PACK|lnz|YUV_RANGE_MIN|replace|src|substr|charAt|zip_bd|115|131|227|193|BMAX|rgba|a_off|y_stride|VP8_STATUS_NOT_ENOUGH_DATA|159|201|225|partition_length_|height_|dc_nz_|id_|ready_|segment_hdr_|||||||||||use_threads_|thread_ctx_|cache_v_|cache_v_off|is_i4x4_|1020|138|146|170|224|196|160|246|166|RIFF|arguments|createElement|url|bytes32|div|name|parseInt|memset|32768|false|case|MODE_YUV|crop_bottom|eof_|135|167|199|231|179|137|141|width_|segments_|filter_row_|f_info_|mb_w_|mb_info_|mem_|non_zero_ac_|clip_8b|p1|FilterLoop26|FilterLoop24|130|134|get_le32|getComputedStyle|||||||||||innerHTML|uint16_t|parse|typeof|memset_|true|rgba_off|size|VP8_STATUS_OK|use_cropping|use_scaling|uv_stride|tmp_y|tmp_u|value_|missing_|207|151|215|187|235|149|165|197|key_frame_|use_segment_|update_map_|sharpness_|f_inner_|y2_mat_|mb_h_|br_mb_y_|alpha_data_|TransformDC|104|124|126|140|152|228|226|198|176|121|218|186|182|toDataURL|waitListNext|param|int8_t|size_t|||||||||||charCodeAt|slice|ArrCopy|memcmp|String|fromCharCode|16383|257|list|error|120|input|MODE_RGBA_4444|private_memory|VP8StatusCode|bypass_filtering|opaque|setup|crop_right|tmp_v|tmp_y_off|tmp_u_off|emit|emit_alpha|203|133|145|173|177|181|185|189|217|absolute_delta_|quantizer_|filter_strength_|level_|skip_|status_|br_|br_mb_x_|dqm_|mem_size_|imodes_|segment_|total_size|Put16|Put8x8uv|do_filter2|q2|106|110|||||||||||118|136|148|117|242|202|180|184|230|220|190|232|188|111|buf_end_off|header|nz_dc|LOAD_UV|test|Binary|background|undefined|len|HTMLCanvasElement|auto|fsWebPid_|char_|void_|int16_t|Byte2Hex|zip_td|288|144|MODE_YUVA|MODE_LAST|a_stride|a_size|is_external_memory|private_memory_off|WebPInitDecBuffer|VP8_STATUS_OUT_OF_MEMORY|VP8_STATUS_UNSUPPORTED_FEATURE|VP8_STATUS_USER_ABORT|put|teardown|fancy_upsampling|data_off|tmp_v_off|options_|buf_|buf_off|VP8InitBitReader|||||||||||139|161|NUM_REF_LF_DELTAS|NUM_CTX|NUM_PROBAS|use_lf_delta_|y1_mat_|uv_mat_|cache_id_|num_caches_|tl_mb_x_|tl_mb_y_|num_parts_|parts_|use_skip_proba_|intra_t_|intra_l_|y_t_|u_t_|v_t_|filter_levels_|alpha_data_size_|layer_data_size_|TrueMotion|Copy32b|132|119|238|216|162|222|178|174|244|142|VP8GetHeaders|cannot|GetCoeffs|out_l_nz|first|YUV_RANGE_MAX|131074|WebPResetDecParams|DecodeInto|GetFeatures|Function|try|catch|min|startDecoding|image|img|||||||||||getContext|toUInt|crc32|callee|getElementById|display|writeResultIntoElement|setTimeout|split|object|short_|long_|int32_t|uint64_t|JSON|join|str|memset_wl|malloc|Arr_nOI|ArrM|throw|WebPDecoder|next|switch|65521|Not|to|MODE_RGBA|MODE_BGRA|WEBP_CSP_MODE|VP8_STATUS_SUSPENDED|data_size|buf_end_|VP8BitUpdate|VP8Shift|147|153|169|229|B_TM_PRED|B_VE_PRED|B_HE_PRED|B_HU_PRED|DC_PRED|V_PRED|H_PRED|TM_PRED|NUM_TYPES|NUM_BANDS|profile_|show_|colorspace_|simple_|ref_lf_delta_|mode_lf_delta_|f_level_|f_ilevel_|error_msg_|frm_hdr_|skip_p_|uvmode_|alpha_data_off|alpha_plane_|VP8DecompressAlphaRows|WebPCopyDecBuffer|dst|TransformOne|hev|needs_filter|needs_filter2|p2|SimpleVFilter16|SimpleHFilter16|frame|MACROBLOCK_VPOS|CheckMode|108|164|214||150|103|194|172|208|200|109|212|123|113|SetOk|VP8Clear|VP8CheckAndSkipHeader|VP8XGetInfo|WebPCheckAndSkipRIFFHeader|Inconsistent|information|VP8Decode|VP8kUToG|VP8kUToB|VP8YuvToArgbKeepA|VP8YuvToArgb|FUNC_NAME|DefaultFeatures|IEBinaryToArray_ByteStr|lastIndex|script|type|text|getElementsByTagName|parentNode|setAttribute|checkAndAddToWaitList|body|images|canvas|btoa|Number|bytes16sw|webbpywebpcanvas|WebPData|Data|waitListProcess|||||||||||||||||||||||||||||||||||||||||||||||||||||readyState|cssText|||className|exec|absolute|left|int64_t|convertBinaryToArray|||||||||||||||||||||||||||||||||||||||||||||||||||||bits|toString|string|65535|N_MAX|continue|HufBuild|286|DataError|enough||||||||||||||||||||||||inflate|uncompress|MODE_BGR|MODE_RGB_565|YUVA|WebPInitDecBufferInternal|has_alpha|bitstream_version|WebPGetFeatures|WebPGetFeaturesInternal|no_fancy_upsampling|crop_width|crop_height|scaled_width|scaled_height|WebPDecoderConfig|options|WebPInitDecoderConfig|WebPInitDecoderConfigInternal|VP8InitIo|VP8InitIoInternal|last_y|OutputFunc|VP8GetByte|VP8GetSigned|233|237|B_RD_PRED|B_VR_PRED|B_LD_PRED|B_VL_PRED|B_HD_PRED|NUM_BMODES|B_DC_PRED_NOTOP|B_DC_PRED_NOLEFT|B_DC_PRED_NOTOPLEFT|NUM_MODE_LF_DELTAS|MAX_NUM_PARTITIONS|xscale_|yscale_|clamp_type_|buffer_flags_|layer_colorspace_|layer_data_|CheckDecBuffer|AllocateBuffer|WebPAllocateDecBuffer|WebPFreeDecBuffer|todo|WebPGrabDecBuffer||VP8DecodeLayer|VP8DspInitTables|dst_off|TransformTwo|TransformUV|TransformDCUV|TransformWHT|VP8TransformWHT|TM4|TM8uv|TM16|VE16|HE16|DC16|DC16NoTop|DC16NoLeft|DC16NoTopLeft|VE4|HE4|DC4|RD4|LD4|VR4|VL4|HU4|HD4|VE8uv|HE8uv|DC8uv|DC8uvNoLeft|DC8uvNoTop|DC8uvNoTopLeft|do_filter4|do_filter6|q3|SimpleVFilter16i|SimpleHFilter16i|VFilter16|HFilter16|VFilter16i|HFilter16i|VFilter8|HFilter8|VFilter8i|HFilter8i|VP8DspInit|InitThreadContext|AllocateMemory|384|InitIo|VP8InitFrame|hev_thresh_from_level|DoFilter|FilterRow|VP8StoreBlock|VP8FinishRow|not|VP8ProcessRow|VP8EnterCritical|Frame|VP8ExitCritical|VP8ReconstructBlock|983040|15728640|122|125|158|VP8ParseQuant|204|210|168|206|107|VP8ResetProba|VP8ParseIntraMode|VP8ParseProba|VP8New|VP8Delete|VP8GetInfo|VP8X|ResetSegmentHeader|ParseSegmentHeader|ParsePartitions|ParseFilterHeader|VP8Io|Invalid|container|ParseResiduals|VP8DecodeMB|VP8InitScanline|ParseFrame|VP8YuvToRgb|VP8YUVInit|UpsampleArgbLinePair|UpsampleArgbKeepAlphaLinePair|InitUpsamplers|FUNC_NAME_SAMPLE|SampleArgbLinePair|EmitSampledRGB|EmitFancyRGB|EmitAlphaRGB|IsAlphaMode|InitFromOptions|CustomSetup|CustomPut|CustomTeardown|WebPInitCustomIo|DecodeIntoRGBABuffer|Decode|WebPGetInfo|WebPDecode|IEBinaryToArray_ByteStr_Script|End|IEBinaryToArray_ByteStr_Last|tIEBinaryToArray_ByteStr_Last|vbscript_IEBinaryToArray_ByteStr|insertBefore|convertResponseBodyToText|WebPJSInit|webpjs|lastIndexOf|checkWebPSupport|onload|webp|base64|IsWebPFile|makeCacheValidUrl|addFilenameToWaitList|removeQuotes|XMLHttpRequest|ActiveXObject|base64encode|adler32|crctable|4294967295|Math|png|map|bitmapToPNGFromCanvas|appendChild|none|InsertIntoCacheList|in_cacheList|PNGDataBase64|addEmbedObjectBG|addEmbedObjectIMG|overrideMimeType|user|defined|responseBody|DecodeWebPImage|getOuterHTML|inline|checkElementHeight|divfsWebPid_|important|ID|classid|clsid|D27CDB6E|AE6D|11cf|96B8|444553540000|FlashVars|mode|movie|wmode|transparent|repeat|top|zIndex|px|ok|float_|double_|score_t|stringify|int64BitLeft|write32BitIn4Bytes|write4BytesIn32Bit|alert32BitIn4Bytes|0x|offset|over|memcpy2|memcpyArrM|membuild_wl|membuild|mallocStr|resStr|Error|fixed_bd|511|1023|2047|4095|8191|32767|258|385|513|769|1025|1537|2049|3073|4097|6145|8193|12289|16385|24577|280|default|Deflate|unshift|Unable|the|MODE_RGB|u_stride|v_stride|y_size|u_size|v_size|no_incremental_decoding|rotate|uv_sampling|force_rotation|no_enhancement|use_threads|B_PRED|NUM_B_DC_MODES|NUM_MV_PROBAS||io_|worker_|WebPWorker|imodes_offset_||alpha_plane_off||layer_data_off|510||STORE|20091|35468|||OUT|mem_offset|no|during||initialization|f_info_off|12851|Could|decode|alpha|failed|259|264|269|274|279|284|105|156|WebPGetDecoderVersion|OK|mismatch|VP8|dec|passed|Truncated|Incorrect|keyframe|parameters|displayable|picture|Bad|code|word|bad|partition|segment|filter|partitions|key|extra|i32|134480385|16777216|65536|4278190080|Premature|end|of|file|encountered|Output|aborted|NULL|parameter|89858|22014|45773|113618|76283|524296|MULT|WEBP|WebPDecodeARGBInto|WebPDecodeARGB||float|styleFloat|toUpperCase|tIEBinaryToArray_ByteStr|CStr|tDim|tlastIndex|LenB|tif|mod|Then|Chr|AscB|MidB|tElse|tEnd|If|vbscript|swf|Image|onerror|UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA|veff|0PP8bA|LwYAAA|http|match|MSXML2|XMLHTTP|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|4294967296|3988292384|call|getImageData|splice|ceil|createImageData|putImageData|removeChild|URL|backgroundImage|selectorText|open|get|plain|charset|setRequestHeader|Accept|Charset|onreadystatechange|responseText|send|cloneNode|imgHeight|imgWidth|styleHeight|styleWidth|nextSibling|relative|index|backgroundRepeat|backgroundPosition|webpFSCommand|finish|imgresize|err|navigator|userAgent|toLowerCase|webkit|timeout|loaded|complete|mozilla|compatible|opera|ready|doScroll".split("|"), 0, {}));

            },
            error: function (data) {
                // console.log('Error:', data);
            }
        });
    });
});
//category wise post

$(document).ready(function () {

    // $('#btn-load-more-category').on('click', function (e) {
    //     $("#btn-load-more-category").prop("disabled", true);
    //     e.preventDefault();
    //     var url = $('#url').val();
    //     $("#latest-preloader-area").removeClass('d-none');

    //     var formData = {
    //         last_id: $('#last_id').val(),
    //         category_id: $('#category_id').val()
    //     };

    //     $.ajax({
    //         type: "GET",
    //         dataType: 'json',
    //         data: formData,
    //         url: url + '/' + 'get-read-more-post-category',
    //         success: function (data) {

    //             $.each(data[0], function (key, value) {
    //                 $(".latest-post-area").append(value);
    //             });

    //             if (data[1] == 1) {
    //                 $("#btn-load-more-category").hide();
    //                 $("#no-more-data").removeClass('d-none');
    //             }

    //             last_id = parseInt($('#last_id').val());
    //             $('#last_id').val(last_id + 1);
    //             $("#btn-load-more-category").prop("disabled", false);

    //             $("#latest-preloader-area").addClass('d-none');
	// 		},
                
    //         error: function (data) {
    //             // console.log('Error:', data);
    //         }
    //     });


    // });

});

//category wise post

$(document).ready(function () {

    // $('#btn-load-more-subcategory').on('click', function (e) {
    //     $("#btn-load-more-subcategory").prop("disabled", true);
    //     e.preventDefault();
    //     var url = $('#url').val();
    //     $("#latest-preloader-area").removeClass('d-none');

    //     var formData = {
    //         last_id: $('#last_id').val(),
    //         category_id: $('#sub_category_id').val()
    //     };

    //     $.ajax({
    //         type: "GET",
    //         dataType: 'json',
    //         data: formData,
    //         url: url + '/' + 'get-read-more-post-subcategory',
    //         success: function (data) {

    //             $.each(data[0], function (key, value) {
    //                 $(".latest-post-area").append(value);
    //             });

    //             if (data[1] == 1) {
    //                 $("#btn-load-more-category").hide();
    //                 $("#no-more-data").removeClass('d-none');
    //             }

    //             last_id = parseInt($('#last_id').val());
    //             $('#last_id').val(last_id + 1);
    //             $("#btn-load-more-category").prop("disabled", false);

    //             $("#latest-preloader-area").addClass('d-none');               

    //         },
    //         error: function (data) {
    //             // console.log('Error:', data);
    //         }
    //     });


    // });

});

$(document).ready(function () {
    var $preInstallationTab = $("#pre-installation-tab"),
        $configurationTab = $("#configuration-tab");

    $(".form-next").on('click', function () {
        if ($preInstallationTab.hasClass("active")) {
            $preInstallationTab.removeClass("active");
            $configurationTab.addClass("active");
            $("#pre-installation").find("i").removeClass("fa-circle-o").addClass("fa-check-circle");
            $("#configuration").addClass("active");
            $("#host").focus();
        }
    });

});

$('#default_storage').on('change', function () {

    if ($(this).val() === "s3") {
        $("#s3Div").show();
    } else {
        $("#s3Div").hide();
    }
});


// showing upload button for video upload

function videoUploadBtn() {
    video_name = $('#video').val();
    $("#video_name").text(video_name);
    $("#divVideoUploadBtn").show();
}

// showing upload button for audio upload

function audioUploadBtn() {
    audio_name = $('#audio').val();
    $("#audio_name").text(audio_name);
    $("#divAudioUploadBtn").show();
}


//installer step change

var onFormSubmit = function ($form) {
    $form.find('[type="submit"]').attr('disabled', 'disabled').find(".loader").removeClass("hide");
    $form.find('[type="submit"]').find(".button-text").addClass("hide");
    $("#alert-container").html("");
};
var onSubmitSussess = function ($form) {
    $form.find('[type="submit"]').removeAttr('disabled').find(".loader").addClass("hide");
    $form.find('[type="submit"]').find(".button-text").removeClass("hide");
};

$(document).ready(function () {
    if (window.File && window.FileList && window.FileReader) {
        $("#images").on("change", function (e) {
            $('.each').remove();
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                // Only process image files.
                if (!files[i].type.match('image.*')) {
                    continue;
                }
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function (e) {
                    var file = e.target;
                    $("<span class=\"each\" id='file" + i + "'>" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + f.name + "\"/>" +
                        "<br/></span>").insertAfter("#images");
                    // {/*<span class=\"remove\"><button type=\"button\" class=\"btn btn-danger px-1 py-0\">x</i></button></span></span>*/}
                    // $(".remove").click(function(){
                    //     console.log($(this).attr('id'));
                    //     $(this).parent(".each").remove();
                    // });

                });
                fileReader.readAsDataURL(f);
            }
            console.log(files);
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});

//select quiz answer format
$(document).on('click', '.btn-group-answer-formats .btn', function () {
    var answer_format = $(this).attr('data-answer-format');
    var question_id = $(this).attr('data-question-id');

    $('.btn_' + question_id).removeClass('active');

    $('#panel_quiz_question_' + question_id + ' .quiz-answers').removeClass('quiz-answers-format-text');
    $('#panel_quiz_question_' + question_id + ' .quiz-answers').removeClass('quiz-answers-format-large-image col-sm-8');
    if (answer_format == 'text') {
        $('#panel_quiz_question_' + question_id + ' .quiz-answers').addClass('quiz-answers-format-text');
    } else if (answer_format == 'large_image') {
        $('#panel_quiz_question_' + question_id + ' .quiz-answers').addClass('quiz-answers-format-large-image col-sm-8');
    }

    $('#input_answer_format_' + question_id).val(answer_format);
    $(this).addClass('active');
});

// quiz question set to collapse same
$(document).on("change input click", "#question_input", function (event) {
    var question_id = $(this).attr('data-question-id');
    var text = $(this).val();
    document.getElementById("question_" + question_id).innerHTML = text;
});

// quiz question set to collapse same
$(document).on("change input click", "#result_input", function (event) {
    var result_id = $(this).attr('data-result-id');
    var text = $(this).val();
    result_dropdowns();
    document.getElementById("result_" + result_id).innerHTML = text;
});

//update quiz result dropdowns options
function result_dropdowns() {
    var result_option_dropdown_array = [];
    var result_ids = [];
    var is_update = $(".input-result-text").attr('data-is-update');
    $("#quiz_result_container .panel-quiz-result").each(function (index) {
        var result_id = $(this).attr("data-result-id");
        var result_text = $("#panel_quiz_result_" + result_id + " .input-result-text").val();
        if (is_update == "1") {
            var option = [result_id, result_text];
        } else {
            var option = [index + 1, result_text];
        }
        result_option_dropdown_array.push(option);
        result_ids.push(result_id);
    });

    $(".personality-quiz-result-dropdown").each(function (index) {
        var val = $(this).val();
        $(this).find('option').remove();
        var i;
        for (i = 0; i < result_option_dropdown_array.length; i++) {
            if (result_option_dropdown_array[i][0] == val) {
                if (is_update == "1") {
                    $(this).append('<option value="' + result_ids[i] + '" selected>' + (i + 1) + '. ' + result_option_dropdown_array[i][1] + '</option>');
                } else {
                    $(this).append('<option value="' + (i + 1) + '" selected>' + (i + 1) + '. ' + result_option_dropdown_array[i][1] + '</option>');
                }
            } else {
                if (is_update == "1") {
                    $(this).append('<option value="' + result_ids[i] + '">' + (i + 1) + '. ' + result_option_dropdown_array[i][1] + '</option>');
                } else {
                    $(this).append('<option value="' + (i + 1) + '">' + (i + 1) + '. ' + result_option_dropdown_array[i][1] + '</option>');
                }

            }
        }
    });
}

$(document).on('click paste input', '.meta', function () {
    var value =$(this).val();
    var type = $(this).attr("data-type");
    if (type == 'title'){
        if ( (value.length < 30 || value.length > 60) && value.length > 0){
            $(this).closest('.form-group').find('.display-nothing.alert-danger').show();
            $(this).closest('.form-group').find('.display-nothing.alert-success').hide();
        } else{
            $(this).closest('.form-group').find('.display-nothing.alert-danger').hide();
            if(value.length > 0){
                $(this).closest('.form-group').find('.display-nothing.alert-success').show();
            }
        }
    }
    else if( type == 'description' ){
        if ( (value.length < 50 || value.length > 160) && value.length > 0){
            $(this).closest('.form-group').find('.display-nothing.alert-danger').show();
            $(this).closest('.form-group').find('.display-nothing.alert-success').hide();
        } else{
            $(this).closest('.form-group').find('.display-nothing.alert-danger').hide();
            if(value.length > 0){
                $(this).closest('.form-group').find('.display-nothing.alert-success').show();
            }
        }
    }
    $(this).closest('.form-group').find('.characters').html(value.length);
});
