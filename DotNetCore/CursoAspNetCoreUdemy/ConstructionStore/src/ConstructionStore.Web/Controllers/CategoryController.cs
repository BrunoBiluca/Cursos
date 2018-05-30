using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using ConstructionStore.Domain.DTOs;
using ConstructionStore.Domain.Product;
using ConstructionStore.Web.ViewModels;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace ConstructionStore.Web.Controllers {
    public class CategoryController : Controller {
        private readonly CategoryStorer _categoryStorer;

        public CategoryController(CategoryStorer categoryStorer) {
            _categoryStorer = categoryStorer;
        }

        // GET: Category
        public ActionResult Index() {
            return View();
        }

        // GET: Category/Details/5
        public ActionResult Details(int id) {
            return View();
        }

        // GET: Category/Create
        public ActionResult Create() {
            return View();
        }

        // POST: Category/Create
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create(CategoryViewModel category) {
            _categoryStorer.Store(category.Id, category.Name);
            return RedirectToAction(nameof(Index));
        }

        // GET: Category/Edit/5
        public ActionResult Edit(int id) {
            return View();
        }

        // POST: Category/Edit/5
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit(int id, IFormCollection collection) {
            try {
                // TODO: Add update logic here

                return RedirectToAction(nameof(Index));
            } catch {
                return View();
            }
        }

        // GET: Category/Delete/5
        public ActionResult Delete(int id) {
            return View();
        }

        // POST: Category/Delete/5
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Delete(int id, IFormCollection collection) {
            try {
                // TODO: Add delete logic here

                return RedirectToAction(nameof(Index));
            } catch {
                return View();
            }
        }
    }
}