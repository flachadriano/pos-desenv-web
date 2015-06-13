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
        <form  class="form-horizontal" action="<c:url value="${transaction.id}"/>" method="POST">
            <fieldset>
                <legend>Transaction ${transaction.id}</legend> 
                <div class="control-group">
                    <label class="control-label" for="category_id">Category</label>
                    <div class="controls">
                        <select name="transaction.category_id" id="category_id">
                            <c:forEach var="category" items="${categories}">
                                <option value="${category.id}"
                                        <c:if
                                            test="${transaction.category_id == category.id}"> selected="true" </c:if>>${category.name}
                                        </option>
                            </c:forEach>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="due_date">Date</label>
                    <div class="controls">
                        <input type="text" name="transaction.due_date" id="due_date" value="${transaction.due_date}" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="value">Value</label>
                    <div class="controls">
                        <input type="text" name="transaction.value" id="value" value="${transaction.value}" />
                    </div>
                </div>
                <div class="control-group">            
                    <label class="control-label" for="description">Description</label>
                    <div class="controls">
                        <input type="text" id="description" name="transaction.description" value="${transaction.description}" />            
                    </div>
                </div>
                <br />
                <input class="btn-primary" type="submit" value="Atualizar" />
            </fieldset>
        </form>
    </div>
</body>
</html>