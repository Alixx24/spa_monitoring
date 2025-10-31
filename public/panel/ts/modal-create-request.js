"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __generator = (this && this.__generator) || function (thisArg, body) {
    var _ = { label: 0, sent: function() { if (t[0] & 1) throw t[1]; return t[1]; }, trys: [], ops: [] }, f, y, t, g = Object.create((typeof Iterator === "function" ? Iterator : Object).prototype);
    return g.next = verb(0), g["throw"] = verb(1), g["return"] = verb(2), typeof Symbol === "function" && (g[Symbol.iterator] = function() { return this; }), g;
    function verb(n) { return function (v) { return step([n, v]); }; }
    function step(op) {
        if (f) throw new TypeError("Generator is already executing.");
        while (g && (g = 0, op[0] && (_ = 0)), _) try {
            if (f = 1, y && (t = op[0] & 2 ? y["return"] : op[0] ? y["throw"] || ((t = y["return"]) && t.call(y), 0) : y.next) && !(t = t.call(y, op[1])).done) return t;
            if (y = 0, t) op = [op[0] & 2, t.value];
            switch (op[0]) {
                case 0: case 1: t = op; break;
                case 4: _.label++; return { value: op[1], done: false };
                case 5: _.label++; y = op[1]; op = [0]; continue;
                case 7: op = _.ops.pop(); _.trys.pop(); continue;
                default:
                    if (!(t = _.trys, t = t.length > 0 && t[t.length - 1]) && (op[0] === 6 || op[0] === 2)) { _ = 0; continue; }
                    if (op[0] === 3 && (!t || (op[1] > t[0] && op[1] < t[3]))) { _.label = op[1]; break; }
                    if (op[0] === 6 && _.label < t[1]) { _.label = t[1]; t = op; break; }
                    if (t && _.label < t[2]) { _.label = t[2]; _.ops.push(op); break; }
                    if (t[2]) _.ops.pop();
                    _.trys.pop(); continue;
            }
            op = body.call(thisArg, _);
        } catch (e) { op = [6, e]; y = 0; } finally { f = t = 0; }
        if (op[0] & 5) throw op[1]; return { value: op[0] ? op[1] : void 0, done: true };
    }
};
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('createRequestModal');
    var openBtn = document.getElementById('openModalRequestBtn');
    var closeBtn = document.getElementById('closeModalBtn');
    var form = document.getElementById('createForm');
    var csrfToken = getCsrfToken();
    // باز و بسته کردن مودال
    if (openBtn && closeBtn && modal) {
        openBtn.addEventListener('click', function () { return modal.style.display = 'block'; });
        closeBtn.addEventListener('click', function () { return modal.style.display = 'none'; });
    }
    // هندل کردن ارسال فرم
    if (form) {
        form.addEventListener('submit', function (e) { return __awaiter(void 0, void 0, void 0, function () {
            var formData, response, data, tbody, newRow, error_1;
            return __generator(this, function (_a) {
                switch (_a.label) {
                    case 0:
                        e.preventDefault(); // جلوگیری از رفرش شدن صفحه
                        formData = new FormData(form);
                        _a.label = 1;
                    case 1:
                        _a.trys.push([1, 4, , 5]);
                        return [4 /*yield*/, fetch(form.getAttribute('action') || '', {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': csrfToken },
                                body: formData,
                                credentials: 'same-origin',
                            })];
                    case 2:
                        response = _a.sent();
                        return [4 /*yield*/, response.json()];
                    case 3:
                        data = _a.sent();
                        if (data.success && data.data) {
                            modal.style.display = 'none';
                            form.reset();
                            tbody = document.querySelector('table tbody');
                            if (tbody) {
                                newRow = document.createElement('tr');
                                newRow.setAttribute('data-row-id', data.data.id);
                                newRow.innerHTML = "\n                            <td>".concat(tbody.children.length + 1, "</td>\n                            <td>").concat(data.data.url, "</td>\n                            <td>").concat(data.data.email, "</td>\n                            <td>").concat(data.data.name, "</td>\n                            <td>").concat(data.data.duration, "</td>\n                            <td>").concat(data.data.created_at, "</td>\n                            <td>\n                                <button class=\"deleteBtn btn btn-danger\" data-id=\"").concat(data.data.id, "\">Delete</button>\n                            </td>\n                        ");
                                tbody.appendChild(newRow);
                            }
                        }
                        else {
                            alert('❌ Failed to create request!');
                            console.error(data);
                        }
                        return [3 /*break*/, 5];
                    case 4:
                        error_1 = _a.sent();
                        console.error(error_1);
                        alert('⚠️ Something went wrong!');
                        return [3 /*break*/, 5];
                    case 5: return [2 /*return*/];
                }
            });
        }); });
    }
});
function getCsrfToken() {
    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta ? tokenMeta.content : '';
}
