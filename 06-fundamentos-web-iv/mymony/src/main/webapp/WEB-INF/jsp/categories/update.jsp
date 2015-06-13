<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <script src="${pageContext.request.contextPath}/js/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="${pageContext.request.contextPath}/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="${pageContext.request.contextPath}/css/bootstrap.min.css" rel="stylesheet">
        <link href="${pageContext.request.contextPath}/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="${pageContext.request.contextPath}/css/theme.css" rel="stylesheet" type="text/css"/>
        <title>MyMony</title>
    </head>
    <body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand " href="#"><strong>MyMony</strong></a>                
            </div>              
            <div class="pull-right navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown-menu-right pull-right">
                        <a class=" btn dropdown-toggle" 
                           data-toggle="dropdown" 
                           role="button" 
                           aria-expanded="false"                           
                           href="#">
                            <i class="glyphicon glyphicon-align-justify
                               glyphicon-white"></i>
                            Menu
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="${pageContext.request.contextPath}/categories/list">Categories</a></li>
                            <li><a href="${pageContext.request.contextPath}/transactions/list">Transactions</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center" role="main">
        <form class="form-horizontal" action="<c:url value="${category.id}"/>" method="POST">
            <fieldset>
                <legend>Transaction ${category.id}</legend> 
                <div class="control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                        <input type="text" name="category.name" id="name" value="${category.name}" />
                    </div>
                    <br />
                    <input class="btn-primary" type="submit" value="Atualizar" />
                </div>
            </fieldset>
        </form>
    </div>
</body>

</html>