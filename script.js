let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; //selecting main parent of arrow
        arrowParent.classList.toggle("showMenu");
    });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

function IsEmailValid(n) {
    if (n === undefined || n.indexOf("@") === -1)
        return !1;
    var t = n.split("@");
    return t.length < 2 || t[0] === "" || t[t.length - 1] === "" || n.indexOf("*") !== -1 ? !1 : !0
}

function IsValidPassword(n) {
    return n === undefined || n.length < 1 || n.length > 450 ? !1 : !0
}

function AccountIsDomainSearch(n) {
    return n.indexOf("*@") !== -1
}

function AccountIsValid(n) {
    return n.length >= 1 && n.length <= 255
}

function getIEVersionOrFalse() {
    var n = window.navigator.userAgent,
        t = n.indexOf("MSIE "),
        r = n.indexOf("Trident/"),
        i;
    return t > 0 ? parseInt(n.substring(t + 5, n.indexOf(".", t)), 10) : r > 0 ? (i = n.indexOf("rv:"),
        parseInt(n.substring(i + 3, n.indexOf(".", i)), 10)) : !1
}

function formatDate(n) {
    var t = new Date(n);
    return t.getDate() + " " + ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
        [t.getMonth()] + " " + t.getFullYear() + ", " + (t.getHours() < 10 ? "0" : "") + t.getHours() + ":" + (t.getMinutes() < 10 ? "0" : "") + t.getMinutes()
}

function numberWithCommas(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function setCookie(n, t) {
    document.cookie = n + "=" + t + ";;path=/;secure"
}

function getCookie(n) {
    for (var t, r = n + "=", u = document.cookie.split(";"),
            i = 0; i < u.length; i++) {
        for (t = u[i]; t.charAt(0) === " ";)
            t = t.substring(1);
        if (t.indexOf(r) === 0) return t.substring(r.length, t.length)
    }
    return ""
}

function htmlEncode(n) {
    return $("<div/>").text(n).html()
}

function htmlDecode(n) {
    return $("<div/>").html(n).text()
}

function search(n) {
    var r = IsEmailValid(n),
        t = "Pwned " + (r ? "email" : "username"),
        i;
    $("#loading").fadeIn(200);
    $(".pwnedSearchResult.panel-collapse.in").collapse("hide");
    AccountIsDomainSearch(n) ? showFailure(t, "Domain search", 'Can\'t wildcard search, try <a href="DomainSearch">the domain search feature<\/a> instead') :
        AccountIsValid(n) ? (i = $(".panel-collapse.in").length === 0, setTimeout(function() {
            getPwnage(n, r, t);
            i = !1
        }, i ? 0 : 400)) :
        showFailure(t, "Invalid address (client)", "That's not a real account!")
}

function getPwnage(n, t, i) {
    var r = $("#apiEndpoint").val() + encodeURIComponent(n);
    $.get(r).done(function(n) { showPwnageDetails(n.Breaches, n.Pastes, t) }).fail(function(n) {
        $(".passwordManagerLink").attr("href", "https://1password.com/haveibeenpwned/goodnews/");
        n.status === 404 ? (t ? $("#noPastesFound").show() : $("#noPastesFound").hide(), $("#noPwnage").collapse("show"), incrementSearchResults(0, 0)) : n.status === 403 ? showFailure(i, "Forbidden", "Your request has been forbidden") : n.status === 429 ? showFailure(i, "Rate limited", "Your request has been rate limited, try again later") : showFailure(i, "Oh no, catastrophic failure!", "Oh no - catastrophic failure!")
    }).always(function() {
        $("#loading").fadeOut(200);
        $("#Account").focus();
        $(".tertiaryHeader").collapse("hide");
        hideKeyboard()
    })
}

function showFailure(n, t, i) {
    setTimeout(function() {
        $("#invalidAccount h2").html(i);
        $("#invalidAccount").collapse("show");
        $("#loading").fadeOut(200)
    }, 400);
    ga("send", "event", n, "Search", t)
}

function showPwnageDetails(n, t, i) {
    var r = "",
        u;
    typeof n == "undefined" || n === null ? (r += 'Not pwned in any <a href="/FAQs#DataSource">data breaches<\/a>', r += i ? ", but found " : "") : n.length === 1 ? (r += 'Pwned in 1 <a href="/FAQs#DataSource">data breach<\/a>', r += i ? " and found " : "") : (r += "Pwned in " + n.length + ' <a href="/FAQs#DataSource">data breaches<\/a>', r += i ? " and found " : "");
    i && (r += typeof t == "undefined" || t === null ? 'no <a href="/FAQs#Pastes">pastes<\/a>' : t.length === 1 ? '1 <a href="/FAQs#Pastes">paste<\/a>' : t.length + ' <a href="/FAQs#Pastes">pastes<\/a>');
    r += ' (<a href="/NotifyMe" class="notifyOfPwning subscribe" data-toggle="modal" data-target="#notifyMeModal" data-remote="false">subscribe<\/a> to search sensitive breaches)';
    $("#pwnCount").html(r);
    $("#pwnedWebsiteBanner").collapse("show");
    incrementSearchResults(n === null ? 0 : n.length, t === null ? 0 : t.length);
    n !== null && ($("#breachDescription").collapse("show"), $.each(n, function(n, t) {
        if ($("#" + t.Name).length === 0) {
            var i = '<span class="pwnedCompanyTitle">' + t.Title;
            t.IsVerified || t.IsFabricated || (i += '<span class="unverified"> (<a href="/FAQs#UnverifiedBreach">unverified<\/a>)<\/span>');
            t.IsFabricated && (i += '<span class="unverified"> (<a href="/FAQs#FabricatedBreach">fabricated<\/a>)<\/span>');
            t.IsSpamList && (i += '<span class="unverified"> (<a href="/FAQs#SpamList">spam list<\/a>)<\/span>');
            i += "<\/span>: ";
            $("#pwnedSites").append('<div class="pwnedSearchResult pwnedWebsite panel-collapse collapse" id="' + t.Name + '"><div class="container"><div class="row"><div class="col-sm-2"><img class="pwnLogo large" src="' + t.LogoPath + '" alt="' + t.Title + ' logo" /><\/div><div class="col-sm-10"><p>' + i + t.Description + '<\/p><p class="dataClasses"><strong>Compromised data:<\/strong> ' + t.DataClasses.join(", ") + "<\/p><\/div><\/div><\/div><\/div>")
        }
        $("#" + t.Name).collapse("show")
    }));
    t !== null && ($("#pasteDescription").collapse("show"), u = '<div class="pwnedSearchResult pwnedWebsite panel-collapse collapse in" id="pastes"><div class="container"><div class="row"><table class="table-striped"><thead><tr><th>Paste title<\/th><th>Date<\/th><th class="text-right">Emails<\/th><\/tr><\/thead><tbody>', $.each(t, function(n, t) {
        u += "<tr>";
        var i;
        t.Source === "Pastebin" ? i = "http://pastebin.com/" + t.Id : t.Source === "Pastie" ? i = "http://pastie.org/pastes/" + t.Id : t.Source === "Slexy" ? i = "http://slexy.org/view/" + t.Id : t.Source === "Ghostbin" ? i = "https://ghostbin.com/paste/" + t.Id : t.Source === "QuickLeak" ? i = "https://www.quickleak.org/" + t.Id : t.Source === "JustPaste" ? i = "http://justpaste.it/" + t.Id : t.Source === "AdHocUrl" ? i = t.Id : console.log('Could not find a URL formatter for source "' + t.Source + '"');
        u += t.Title === null ? '<td class="noPasteTitle"><a href="' + i + '" target="_blank" rel="noopener">No title<\/a><\/td>' : '<td><a href="' + i + '" target="_blank" rel="noopener">' + htmlEncode(t.Title) + "<\/a><\/td>";
        u += t.Date === null ? '<td class="pasteDate">Unknown<\/td>' : '<td class="pasteDate">' + formatDate(t.Date) + "<\/td>";
        u += '<td class="text-right">' + numberWithCommas(t.EmailCount) + "<\/td><\/tr>"
    }), u += "<\/tbody><\/table><\/div><\/div><\/div>", $("#pastes").append(u), $("pastes").collapse("show"));
    $(".passwordManagerLink").attr("href", "https://1password.com/haveibeenpwned/ohno/")
}

function incrementSearchResults(n, t) {
    var r = parseInt(getCookie("Searches")),
        f = isNaN(r) ? 1 : r + 1,
        u = parseInt(getCookie("BreachedSites")),
        i;
    n = isNaN(u) ? n : u + n;
    i = parseInt(getCookie("Pastes"));
    t = isNaN(i) ? t : i + t;
    setCookie("Searches", f);
    setCookie("BreachedSites", n);
    setCookie("Pastes", t)
}

function showBreach(n) {
    var t = '<img class="pwnLogo large modalLogo" src="' + n.LogoPath + '" alt="' + n.title + ' logo" />' + n.Description;
    $("#pwnModelHeading").text(n.Title);
    $("#pwnModalBody").html(t)
}
$(function() {
    $(".socialLink").click(function(n) {
        n.preventDefault();
        window.open(this.href, "SocialWindow", "width=550,height=520")
    })
});
var hideKeyboard = function() {
    var n = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
    n && (document.activeElement.blur(), $("input").blur())
};
$(function() {
    getIEVersionOrFalse() || $("#Account").focus();
    $("#searchPwnage").click(function(n) {
        n.preventDefault();
        var t = $("#Account").val();
        search(t)
    })
});
$(document).ready(function() {
    var n = $("#Account").val();
    n !== undefined && n !== "" && window.location.pathname.indexOf("/account") !== 0 && search(n)
});
$("#showRawData").click(function() {
    $("#showRawData").hide();
    $("#hideRawData").show();
    $(".pwnedData").collapse("show")
});
$("#hideRawData").click(function() {
    $("#showRawData").show();
    $("#hideRawData").hide();
    $(".pwnedData").collapse("hide")
});
$(function() {
    $(".pwnedCompanyList a").click(function(n) {
        var t = $(this).attr("data-pwned");
        t !== undefined && (n.preventDefault(), $("#pwnModelHeading").text("Loading..."), $("#pwnModalBody").html('<i class="fa fa-3x fa-cog fa-spin fa-loader"><\/i>'), $.getJSON("/api/v2/breach/" + t, function(n) { showBreach(n) }).fail(function() {
            $("#pwnModelHeading").text("Oh no, catastrophic failure!");
            $("#pwnModalBody").html("")
        }), ga("send", "Pwned site", "Modal", t))
    })
});
$(document).ready(function() {
    $(".notifyOfPwning").click(function(n) {
        n.preventDefault();
        var t = $("#Account").val();
        IsEmailValid(t) && $("#NotifyEmail").val(t);
        grecaptcha.reset()
    });
    $("#notifySubmission #notifyMeForm").submit(function(n) {
        var t, i;
        n.preventDefault();
        t = $("#NotifyEmail").val();
        IsEmailValid(t) ? (i = $(this).serialize(), $("#notifyError").hide(), $("#notificationLoading").css("display", "inline-block"), $.post("/api/notifyme", i).done(function() {
            $("#notifySubmission").collapse("hide");
            setTimeout(function() { $("#notifySuccess").collapse("show") }, 400)
        }).fail(function(n) {
            var t = $.parseJSON(n.responseText).Message;
            n.status == 400 && t == "NoCaptcha" ? ($("#notifyError").text("You must try to prove you're not a robot!"), ga("send", "event", "Subscription", "Signup", 'Missing "No CAPTCHA reCAPTCHA"')) : n.status == 400 && t == "BadCaptcha" ? ($("#notifyError").text("You didn't prove that you're not a robot!"), ga("send", "event", "Subscription", "Signup", 'Invalid "No CAPTCHA reCAPTCHA"')) : n.status == 400 && t == "BadEmail" ? ($("#notifyError").text("That's not a real email address!"), ga("send", "event", "Subscription", "Signup", "Invalid address (server)")) : ($("#notifyError").text("Uh oh, something went wrong. Try again?"), ga("send", "event", "Subscription", "Signup", "Generic failure"));
            $("#notifyError").show()
        }).always(function() {
            $("#notificationLoading").hide();
            hideKeyboard()
        })) : ($("#notifyError").text("That doesn't look like a valid email address"), $("#notifyError").show(), ga("send", "event", "Subscription", "Signup", "Invalid address (client)"))
    });
    $("#addAnotherNotification").click(function(n) {
        n.preventDefault();
        $("#NotifyEmail").val("");
        $("#notifySuccess").collapse("hide");
        $("#notifySubmission").collapse("show");
        grecaptcha.reset()
    });
    $("#notifyMeModal").on("shown.bs.modal", function() { $("#NotifyEmail").focus() });
    $("#notifyMeModal").on("hidden.bs.modal", function() {
        $("#notifyMeModal .panel-collapse.in").collapse("hide");
        $("#notifyError").hide();
        setTimeout(function() { $("#notifySubmission").collapse("show") }, 400)
    })
})